<?php

namespace App\Admin\Actions\Grid;

use App\Models\InstallmentItem;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class InstallmentPayFailed extends RowAction
{
    /**
     * @return string
     */
	protected $title = '未收到转账！';

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
        $item->status = InstallmentItem::STATUS_FAILED;
        $item->save();

        return $this->response()
            ->success('操作成功!'.$this->getKey())
            ->refresh();
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		 return ['未收到转账?', '操作后 用户将重新上传支付凭证'];
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
