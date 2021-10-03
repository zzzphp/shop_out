<?php

namespace App\Http\Controllers\Api;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CollectionController extends Controller
{
    //
    public function show(Request $request)
    {
        $request->validate(['type' => 'required']);
        $collection = Collection::query()->firstOrNew([
                'hash_key' => hashKey($request->user()->id, $request->input('type', Collection::TYPE_BANK)),
                'user_id' => $request->user()->id,
                'type'    => $request->input('type', Collection::TYPE_BANK),
            ]);
        return response()->json(['data' => $collection]);
    }

    public function update(Request $request)
    {
        $request->validate(['code' => 'required',
            'key' => 'required',
            'type' => 'required',
        ]);
        $cacheData = Cache::get($request->key);
        $phone  = $request->user()->phone;
        if(!$cacheData) {
            $this->errorResponse(400, '验证码已过期');
            return response()->json(['message' => '验证码已过期'])->setStatusCode(400);
        }
        if($request->code != $cacheData['code'] || $phone != $cacheData['phone']) {
            // 验证码错误
            $this->errorResponse(400, '验证码错误');
        }
        // 清除验证码
        Cache::pull($request->key);

        $collection = Collection::query()
            ->where('user_id', $request->user()->id)
            ->where('type', $request->input('type', Collection::TYPE_BANK))
            ->firstOrCreate();
        $data = [];
        switch ($request->type) {
            case Collection::TYPE_BANK:
                $request->validate(['bank' => 'required',
                    'bank_card' => 'required',
                    'payee' => 'required',
                ]);
                $data['bank'] = $request->input('bank', '');
                $data['bank_card'] = $request->input('bank_card', '');
                $data['payee'] = $request->input('payee', '');
                break;
            case Collection::TYPE_WEIXIN:
                $request->validate(['username' => 'required',
                    'qrcode' => 'required',
                ]);
                $data['username'] = $request->input('username', '');
                $data['qrcode'] = $request->input('qrcode', '');
                break;
            case Collection::TYPE_ALIPAY:
                $request->validate(['username' => 'required',
                    'real_name' => 'required',
                    'qrcode' => 'required',
                ]);
                $data['username'] = $request->input('username', '');
                $data['real_name'] = $request->input('real_name', '');
                $data['qrcode'] = $request->input('qrcode', '');
                break;
        }
        $collection->data = $data;
        $collection->save();
        return response()->json(['data' => $collection]);
    }

}
