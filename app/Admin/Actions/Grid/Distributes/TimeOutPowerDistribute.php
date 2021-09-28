<?php

namespace App\Admin\Actions\Grid\Distributes;

use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\PowerDistribute;
use App\Jobs\FirstDistribute;

class TimeOutPowerDistribute extends RowAction
{
    /**
     * @return string
     */
	protected $title = '已超时10分钟！重新发币';

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

        $distribute = PowerDistribute::find($this->getKey());
        if($distribute->status !== PowerDistribute::STATUS_PENDING) {
            return $this->response()
            ->error('该订单无需重新发币！ '.$this->getKey())
            ->refresh();
        }

        FirstDistribute::dispatch($distribute);
        $distribute->status = PowerDistribute::STATUS_NONE;
        $distribute->save();
        return $this->response()
            ->success('重新发币成功，请等待结果！ '.$this->getKey())
            ->refresh();
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		// return ['Confirm?', 'contents'];
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
