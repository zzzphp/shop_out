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

class OrderSetInvalid extends RowAction
{
    /**
     * @return string
     */
	protected $title = '取消有效算力';

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
        if ($order->status !== Order::STATUS_EFFECTIVE) {
            return $this->response()->error('订单状态 必须为 有效算力');
        }
        DB::transaction(function () use ($order){
            OrderService::subPowers($order);
            $order->status = Order::STATUS_INVALID;
            $order->save();
        });
        return $this->response()
            ->success('设置成功，算力已扣除 '.$this->getKey())
            ->refresh();
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		 return ['确认扣除该订单算力?', '该订单算力将失效~'];
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
