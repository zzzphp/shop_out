<?php

namespace App\Admin\Actions\Grid;

use App\Models\Order;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OrderUnlock extends RowAction
{
    /**
     * @return string
     */
	protected $title = '驳回反馈';

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
        Order::query()
            ->where('id', $id)
            ->limit(1)
            ->update(['status' => Order::STATUS_RELEASE]);
        return $this->response()
            ->success('Processed successfully: '.$this->getKey())
            ->redirect('/');
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		 return ['确认驳回反馈?', '驳回后 订单将进入待收货状态，需要卖家手动放货！'];
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
