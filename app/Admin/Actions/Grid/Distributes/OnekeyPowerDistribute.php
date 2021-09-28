<?php

namespace App\Admin\Actions\Grid\Distributes;

use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Jobs\FirstDistribute;
use App\Models\PowerDistribute;

class OnekeyPowerDistribute extends RowAction
{
    /**
     * @return string
     * 算力发币
     */
	protected $title = '一键发币';

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
        if($distribute->status !== PowerDistribute::STATUS_NONE) {
            return $this->response()
            ->error('请勿重复操作 '.$this->getKey())
            ->refresh();
        }
        FirstDistribute::dispatch($distribute);
        return $this->response()
            ->success('发币成功 '.$this->getKey())
            ->refresh();
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		return ['确认发币?', '请确认发币参数！'];
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
