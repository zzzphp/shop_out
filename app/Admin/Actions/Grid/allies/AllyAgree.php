<?php

namespace App\Admin\Actions\Grid\allies;

use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Ally;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AllyAgree extends RowAction
{
    /**
     * @return string
     */
	protected $title = '同意（升为盟友等级）';

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
        $ally = Ally::find($this->getKey());
        $user = User::find($ally->user_id);
        if($ally->status !== Ally::STATUS_PEDING) {
            return $this->response()
            ->error('该数据已经审核 '.$this->getKey());
        }
        $power = config('app.identity_system.top.power');
            if($user->myPowers() < $power) {
                return $this->response()
                ->error('该用户未达到盟友条件'.$this->getKey());
        }
        DB::transaction(function () use ($user,$ally) {
            // 改变用户身份 并且 审核该条订单
            $user->grade = User::GRADE_TOP;
            $user->save();
            
            $ally->status = Ally::STATUS_AGREE;
            $ally->save();
        });
        return $this->response()
            ->success('成功，该用户已成为盟友'.$this->getKey())
            ->refresh();
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		return ['确认同意?', '确认后用户等级将升为盟友'];
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
