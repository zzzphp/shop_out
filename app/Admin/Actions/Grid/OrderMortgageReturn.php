<?php

namespace App\Admin\Actions\Grid;

use App\Models\AssetDetails;
use App\Models\Order;
use App\Models\Wallet;
use App\Services\WalletService;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderMortgageReturn extends RowAction
{
    /**
     * @return string
     */
	protected $title = '退还质押币';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        $order = Order::find($this->getKey());
        if ($order->status !== Order::STATUS_INVALID) {
            return $this->response()->error('当前订单状态不正确 ~');
        }
        DB::transaction(function () use ($order){
            $mortgage = $order->mortgage;
            // 增加钱包余额
            $wallet = Wallet::query()
                ->where(['user_id' => user_id, 'currency_id' => $order->currency_id, 'type' => $order->currency->type])
                ->first();
            $wallet->addAmount($mortgage['user'], AssetDetails::TYPE_PLEDGE_RETURN);
            // 扣除订单的用户质押 更改订单状态
            $mortgage['user'] = 0;
            $order->mortgage = $mortgage;
            $order->status = Order::STATUS_PLEDGE_RETURN;
            $order->save();
        });
        return $this->response()
            ->success('质押币退回成功 '.$this->getKey())
            ->refresh();
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		 return ['退还该订单质押币？', '请检查该订单，确认用户质押无误！'];
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
