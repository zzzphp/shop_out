<?php

namespace App\Admin\Actions\Grid\Distributes;

use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Distribute;
use App\Jobs\LssueCurrencyJob;

class LssueCurrency extends RowAction
{
    /**
     * @return string
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
        $id = $this->getKey();
        $distribute = Distribute::find($id);
        if($distribute->status !== Distribute::STATUS_NO_STARTED) {
            return $this->response()
            ->error('请勿重复擦操作！'.$this->getKey())
            ->refresh();
        }
        // 更改发币状态
        $distribute->status = Distribute::STATUS_PENDING;
        $distribute->save();
        // 写入发布队列
        dispatch(new LssueCurrencyJob($distribute));
        return $this->response()
            ->success('发币成功 '.$this->getKey())
            ->refresh();
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		return ['请确认填写信息正确无误！', ''];
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
