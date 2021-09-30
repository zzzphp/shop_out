<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yansongda\LaravelPay\Facades\Pay;

class NotifyController extends Controller
{
    //
    public function alipayRechargeReturn(Request $request)
    {
        $result = Pay::alipay()->callback();
        Log::info($result);
    }
}
