<?php

namespace App\Admin\Actions\Grid\Withdrawals;

use App\Models\AssetDetails;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Withdrawal;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class WithdrawalsReject extends RowAction
{
    /**
     * @return string
     */
	protected $title = '驳回';

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
        $withdrawals = Withdrawal::find($this->getKey());

        // 首先判断状态
        if($withdrawals->status !== Withdrawal::STATUS_PENDING) {
            return $this->response()
            ->error('请勿重复审核: '.$this->getKey())
            ->refresh();
        }

        DB::transaction(function () use ($withdrawals) {
            // 驳回 增加 可用数量 减少 冻结资金
            $wallet = Wallet::where(['user_id' => $withdrawals->user_id,
                'currency_id' => $withdrawals->currency_id,
                'type' => $withdrawals->currency->type,
            ])->first();
//            $wallet->amount = add($wallet->amount, $withdrawals->amount);
//            $wallet->frozen_amount = sub($wallet->frozen_amount, $withdrawals->amount);
            $wallet->addAmount($withdrawals->amount, AssetDetails::TYPE_FROZEN_RETURN);
            $wallet->subFrozenAmount($withdrawals->amount);
            // 更改 审核状态
            $withdrawals->status = Withdrawal::STATUS_FAILED;
            $withdrawals->save();
        });
        return $this->response()
            ->success('驳回成功: '.$this->getKey())
            ->refresh();
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		return ['确认驳回？', '驳回后将冻结数量退回原来账户'];
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
