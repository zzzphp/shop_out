<?php

namespace App\Admin\Actions\Grid\Withdrawals;

use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Withdrawal;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class WithdrawalsAgree extends RowAction
{
    /**
     * @return string
     */
	protected $title = '已转账';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        $withdrawals = Withdrawal::find($this->getKey());
        // 首先判断状态
        if($withdrawals->status !== Withdrawal::STATUS_PENDING) {
            return $this->response()
            ->error('请勿重复审核: '.$this->getKey())
            ->refresh();
        }
        DB::transaction(function () use ($withdrawals) {
            $wallet = Wallet::where(['user_id' => $withdrawals->user_id,
                'currency_id' => $withdrawals->currency_id,
                'type' => $withdrawals->currency->type,
            ])->first();
            // 同意 减少冻结金额 增加 提现金额
            $wallet->subFrozenAmount($withdrawals->amount);
            $wallet->addWithdrawalAmount($withdrawals->amount);
            // 更改审核状态
            $withdrawals->status = Withdrawal::STATUS_SUCCESS;
            $withdrawals->save();
        });
        return $this->response()
            ->success('审核成功: '.$this->getKey())
            ->refresh();
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		return ['请确认已经成功到对方账户？', ''];
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
