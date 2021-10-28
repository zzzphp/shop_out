<?php

namespace App\Admin\Actions\Grid;

use App\Models\Order;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderForceRelease extends RowAction
{
    /**
     * @return string
     */
	protected $title = '强制放货';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        $id = $this->getKey();
        DB::transaction(function () use ($id){
            $order = Order::find($id);
            if ($order->status !== Order::STATUS_RELEASE) {
                return $this->response()->error('订单状态不正确');
            }
            $order->status = Order::STATUS_SUCCESS;
            $order->save();
            // 将卖家的订单数量减少
            $sell_order = Order::find($order->product->origin_order);
            if ($sell_order->status !== Order::STATUS_BUY) {
                return $this->errorResponse(400, '卖家订单状态不正确');
            }
            $sell_order->amount = $sell_order->amount - $order->amount;
            if ($sell_order->amount <= 0) {
                $sell_order->status = Order::STATUS_COMPLETE_SELL;
            }
            $sell_order->save();
        });
        return $this->response()
            ->success('放货成功 '.$this->getKey())
            ->refresh();
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		 return ['确认放货?', '放货后该订单不可更改'];
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
