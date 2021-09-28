<?php

namespace App\Admin\Actions\Grid;

use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Miner;
use App\Models\Power;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderEffectiveRow extends RowAction
{
    /**
     * @return string
     */
	protected $title = '有效订单';

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
        if($order->closed === true || $order->status !== Order::STATUS_SUCCESS) {
            return $this->response()
            ->error('该订单未支付成功！ '.$this->getKey());
        }
        DB::transaction(function () use ($order) {
            // 先将订单划为有效订单
            $order->status = Order::STATUS_EFFECTIVE;
            $order->save();
            // 判断该产品是算力产品还是整机
            if($order->product->type === Product::TYPE_COMPLETE) {
                // 划到矿机数量
                $miner = Miner::firstOrNew(['user_id' => $order->user_id, 'currency_id' => $order->currency_id, 'product_id' => $order->product_id]);
                $miner->amount = $miner->amount + $order->amount;
                $miner->save();
            } else {
                // 是算力产品
                $power = Power::firstOrNew(['user_id' => $order->user_id, 'currency_id' => $order->currency_id, 'stage_id' => $order->product->stage_id]);
                $power->power = $power->power + $order->amount;
                $power->save();
            }
        });
        return $this->response()
            ->success('操作成功'.$this->getKey())->refresh();
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		return ['确认更改为有效订单？', '有效订单将每天进行发币！'];
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
