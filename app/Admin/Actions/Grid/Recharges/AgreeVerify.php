<?php

namespace App\Admin\Actions\Grid\Recharges;

use App\Models\AssetDetails;
use Dcat\Admin\Actions\Response;
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
