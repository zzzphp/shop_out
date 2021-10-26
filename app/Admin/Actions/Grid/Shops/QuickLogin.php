<?php

namespace App\Admin\Actions\Grid\Shops;

use App\Models\Shop;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

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
        $shop = Shop::find($this->getKey());
        $admin = DB::table('admin_users')->find($shop->admin_id);
        $rand_key = 'quick_login_token' . Str::random(8);
        Cache::put($rand_key, time(), 8);
        $params = http_build_query(['username' => $admin->username, 'password' => $admin->password, 'key' => $rand_key]);
        $url = env('ADMIN_URL').'/quick_login?' . $params;
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
