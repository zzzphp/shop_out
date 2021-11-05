<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;
use Illuminate\Support\Facades\Cache;

class VerificationCodesController extends Controller
{
    //
    public function store(Request $request)
    {
        $validatedData = $request->validate(['phone' => 'required']);
        $phone = $request->phone;
        if (!app()->environment('production')) {
            // 测试环境
            $code = 1234;
        } else {
            // 生成4位随机整数，左侧补零
            $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);
            try {
                $easySms = new EasySms(config('easysms'));
                $result = $easySms->send($phone, [
                    'template' => config('easysms.gateways.ucloud.template.codes'),
                    'data' => [
                        'code' => $code
                    ],
                ]);
            } catch (NoGatewayAvailableException $exception) {
                $message = $exception->getException('aliyun')->getMessage();
                abort(500, $message ?: '短信发送异常');
            }
        }
        // 存储验证码
        $key = 'VerificationCodes' . \Illuminate\Support\Str::random(15);
        $expiredAt = now()->addMinutes(5); // 过期时间5分钟
        Cache::put($key, ['phone' => $phone, 'code' => $code], $expiredAt);

        return response()->json(['key' => $key]);
    }

}
