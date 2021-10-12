<?php

namespace App\Admin\Actions\Grid;

use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderPaidFailedRow extends RowAction
{
    /**
     * @return string
     */
	protected $title = '支付失败，取消订单';

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
        $order = Order::find($id);
        if($order->closed === true || $order->status !== Order::STATUS_PENDING) {
            return $this->response()
            ->error('该订单已被审核 '.$this->getKey());
        }
//        $order->closed = true; // 关闭订单
        DB::transaction(function () use ($order){
            // 增加库存
            $this->order->product->addStock($this->order->amount);
            $order->status = Order::STATUS_FAILED; // 将订单设置为失败
            $order->save();
        });
        return $this->response()
            ->success('操作成功 '.$this->getKey())->refresh();
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		return ['确认未收到货款?', '拒绝后该订单将会关闭！'];
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
