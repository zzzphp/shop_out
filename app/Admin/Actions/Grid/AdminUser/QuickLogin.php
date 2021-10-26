<?php

namespace App\Admin\Actions\Grid\AdminUser;

use App\Models\Shop;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class QuickLogin extends RowAction
{
    /**
     * @return string
     */
	protected $title = '自动登录';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        Auth::guard('admin')->loginUsingId($this->getKey());
        $url = env('ADMIN_URL').'/'.config('admin.route.prefix');

         return $this->response()->script(
            <<<EOF
window.open("$url","_blank");
EOF
        );
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
