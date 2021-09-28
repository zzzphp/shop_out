<?php

namespace App\Admin\Actions\Grid;

use App\Models\Order;
use App\Services\OrderService;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderSetEffective extends RowAction
{
    /**
     * @return string
     */
	protected $title = '设置有效算力';

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
        $order = Order::find($this->getKey());
        if ($order->status !== Order::STATUS_SUCCESS) {
            return $this->response()->error('该订单没有支付成功，无法设置~');
        }
        // 订单收益日期是否为当天
        if (!$order->profit_data || $order->profit_data['begin'] !== date('Y-m-d', time())) {
            return $this->response()->error('请将该订单 开始收益日期 设置为当天~');
        }
        DB::transaction(function () use ($order){
            // 添加有效算力
            OrderService::addPowers($order);
            $order->status = Order::STATUS_EFFECTIVE;
            $order->save();
        });
        return $this->response()
            ->success('有效算力 设置成功'.$this->getKey())
            ->refresh();
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		 return ['请确认收益日期为当天？', '将该订单算力/节点设置为有效'];
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
