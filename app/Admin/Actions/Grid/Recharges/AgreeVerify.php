<?php

namespace App\Admin\Actions\Grid\Recharges;

use App\Exceptions\InternalException;
use App\Models\AssetDetails;
use App\Models\Shop;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Recharge;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class AgreeVerify extends RowAction
{
    /**
     * @return string
     */
	protected $title = '充币通过';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        // dump($this->getKey());
        $id = $this->getKey();
        $recharge = Recharge::find($id);
        if($recharge->status !== Recharge::STATUS_PENDING) {
            return $this->response()
                ->error('该订单已审核，请勿重复操作'.$this->getKey());
        }
        DB::transaction(function () use($recharge) {
            $wallet = Wallet::where(['user_id' => $recharge->user_id,
                                    'currency_id' => $recharge->currency_id,
                            ])
                        ->first();
            if(!$wallet) {
                return $this->response()
                ->error('操作失败，该钱包不存在，请检查！'.$this->getKey());
            }
            // 当前账号为馆长
            if(Admin::user()->isRole('curator')) {
                $shop = Shop::query()
                    ->lockForUpdate()
                    ->where('admin_id', Admin::user()->id)
                    ->first();
                if (!$shop) {
                    throw new InternalException('当前账号未开通馆长');
                }
                // 当前币种
                $current_coin = [];
                $data = $shop->quota_data;
                foreach ($data as $k => $value) {
                    if (intval($value['currency_id']) === $wallet->currency_id) {
                        $current_coin['key'] = $k;
                        $current_coin['amount'] = $value['amount'];
                    }
                }
                if (!$current_coin) {
                    throw new InternalException('未开通当前币种充值权限');
                }
                if (comp($recharge->amount, $current_coin['amount'])) {
                    throw new InternalException('当前额度不足，请联系平台充值');
                }
                // 扣除当前额度
                $data[$current_coin['key']]['amount'] = sub($current_coin['amount'], $recharge->amount);
                $shop->quota_data = $data;
                $shop->save();
            } else {
                if (!Admin::user()->isRole('administrator')) {
                    throw new InternalException('非法充值！');
                }
            }
            // 增加数量到钱包
            $wallet->addAmount($recharge->amount, AssetDetails::TYPE_RECHARGE);
            // 更改当前订单状态
            $recharge->status = Recharge::STATUS_SUCCESS;
            $recharge->save();
        });

        return $this->response()
            ->success('操作成功'.$this->getKey())->refresh();
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		return ['确认通过？', ''];
	}

    /**
     * @param Model|Authenticatable|HasPermissions|null $user
     *
     * @return bool
     */
    protected function authorize($user): bool
    {
        return true;
    }

    /**
     * @return array
     */
    protected function parameters()
    {
        return [];
    }
}
