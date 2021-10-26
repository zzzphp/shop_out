<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Http\Controllers\AuthController as BaseAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AuthController extends BaseAuthController
{
    public function quickLogin(Request $request)
    {
        $admin = DB::table('admin_users')
            ->where('username', $request->username)
            ->first();
        if (hash_equals($admin->password, $request->password) && Cache::get($request->key)) {
            Auth::guard('admin')->loginUsingId($admin->id);
            dd(11);
        }
        return redirect(config('admin.route.prefix'));
    }
}
