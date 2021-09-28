<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests;
    //
    public function errorResponse($statusCode, $message = null, $code = 0)
    {
        throw new HttpException($statusCode, $message, null, [], $code);
    }

    public function validateSmsCode($phone, $key, $code)
    {
        $cacheData = Cache::get($key);
        if(!$cacheData) {
            $this->errorResponse(400, '验证码已过期');
        }
        if($code != $cacheData['code'] || $phone != $cacheData['phone']) {
            // 验证码错误
            $this->errorResponse(400, '验证码错误');
        }
        // 清除验证码
        Cache::pull($key);
    }
}
