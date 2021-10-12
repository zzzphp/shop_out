<?php

namespace App\Admin\Actions\Grid;

use App\Models\Order;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OrderTakeGoods extends RowAction
{
    /**
     * @return string
     */
	protected $title = '强制提货';

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
        $id = $this->getKey();
        $order = Order::find($id);
        if ($order->status !== Order::STATUS_SUCCESS) {
            return $this->response()->error('订单状态不正确');
        }
        $order->status = Order::STATUS_TAKE;
        $order->save();
        return $this->response()
            ->success('Processed successfully: '.$this->getKey())
            ->redirect('/');
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		 return ['确认强制提货？', '订单将只能进行提货'];
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
