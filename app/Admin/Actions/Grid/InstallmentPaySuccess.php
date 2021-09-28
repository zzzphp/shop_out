<?php

namespace App\Admin\Actions\Grid;

use App\Models\InstallmentItem;
use App\Models\Order;
use App\Services\OrderService;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstallmentPaySuccess extends RowAction
{
    /**
     * @return string
     */
	protected $title = '确认支付';

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
        $item = InstallmentItem::find($this->getKey());
        if (!$item->paid_at || !$item->pay_prove || $item->status === InstallmentItem::STATUS_PENDING) {
            return $this->response()
                ->error('认分期订单数据异常！'.$this->getKey())->refresh();
        }
        // 如果订单逾期，则增加扣除的算力
        if ($item->installment->order->status === Order::STATUS_OVERDUE) {
            DB::transaction(function () use ($item){
                $order = $item->installment->order;
                OrderService::addPowers($order);
                $order->status = Order::STATUS_EFFECTIVE;
                $order->save();
            });
        }
        $item->status = InstallmentItem::STATUS_SUCCESS;
        $item->save();
        return $this->response()
            ->success('还款成功 '.$this->getKey())
            ->refresh();
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		 return ['确认已收到转账?', '确认后，用户则正常收到收益'];
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
