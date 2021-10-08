<?php

namespace App\Admin\Actions\Grid;

use App\Services\InstallmentService;
use App\Services\WalletService;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Models\Miner;
use App\Models\User;
use App\Models\Commission;
use App\Jobs\CommissionOrder;
use App\Models\Product;
use App\Models\Power;

class OrderPaidVerifyRow extends RowAction
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
        $order = Order::find($this->getKey());
        if($order->closed === true || $order->status !== Order::STATUS_RELEASE) {
            return $this->response()
            ->error('订单状态不正确 '.$this->getKey());
        }
        // 使用事务将订单设置为 购买成功，并且将算力增加到用户钱包
        DB::transaction(function () use ($order) {
            // 先将订单划为购买成功
            $order->status = Order::STATUS_SUCCESS;
            $order->save();
        });
        return $this->response()
            ->success('操作成功'.$this->getKey())->refresh();
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		return ['确认收到货款？', '确认后将会把矿机增加到用户账号！'];
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
