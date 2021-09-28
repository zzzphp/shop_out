<?php

namespace App\Admin\Actions\Grid\Recharges;

use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Recharge;

class RefuseVerify extends RowAction
{
    /**
     * @return string
     */
	protected $title = '未收到，关闭订单';

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
        $recharge = Recharge::find($id);
        if($recharge->status !== Recharge::STATUS_PENDING) {
            return $this->response()
                ->error('该订单已审核，请勿重复操作'.$this->getKey());
        }
        // 将订单更改未失败
        $recharge->status = Recharge::STATUS_FALED;
        $recharge->save();
        return $this->response()
            ->success('操作成功 '.$this->getKey());
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		return ['未收到？', '确认后该订单将失效！'];
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
