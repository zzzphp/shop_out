<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// 支付后回调

Route::prefix('v1')->namespace('Api')->name('api.v1.')->group(function(){
    Route::post('payment/alipay/notify', 'NotifyController@alipayRechargeNotify');
    Route::get('/', 'AuthorizationsController@store');
    // 节流处理防止攻击
    Route::middleware('throttle:3,1')->group(function (){
        // 短信验证码
        Route::post('verificationCodes', 'VerificationCodesController@store')->name('verificationCodes.store');
        // 上传助手
        Route::post('upload', 'UploaderController@store')->name('Uploader.store');
    });
    // 登录相关的 // 节流处理防止攻击
    Route::middleware('throttle:10,1')->group(function (){
        // 快捷登录
        Route::post('authorization', 'AuthorizationsController@store')->name('users.store');
        // 注册
        Route::post('register', 'AuthorizationsController@register')->name('users.register');
        // 普通登录
        Route::post('login', 'AuthorizationsController@login')->name('users.login');
        // 刷新TOKEN
        Route::put('refresh', 'AuthorizationsController@update');
        // 退出登录
        Route::delete('logout', 'AuthorizationsController@destroy');
        // 微信公众号登录
        Route::get('official', 'AuthorizationsController@official')->name('users.official');
        // 修改密码
        Route::put('find', 'AuthorizationsController@findPassword')->name('Authorizations.find');
    });
    // 资讯列表
    Route::get('news', 'NewsController@index')->name('News.index');
    // 资讯详情
    Route::get('news/{new}', 'NewsController@show')->name('News.show');
    Route::get('news/information/{information}', 'NewsController@information');
    // 行情列表
    Route::get('market', 'CurrencyMarketController@index')->name('CurrencyMarket.index');
    Route::get('market_index', 'CurrencyMarketController@index_center')->name('CurrencyMarket.index_center');
    // 产品列表
    Route::get('products', 'ProductsController@index')->name('products.index');
    // 产品详情
    Route::get('products/{product}', 'ProductsController@show')->name('products.show');
    // 币种列表
    Route::get('currencies', 'CurrenciesController@index')->name('currencies.index');
    // 首页轮播图
    Route::get('carousels', 'CarouselsController@index')->name('carousels.index');
    // 公告列表
    Route::get('notices', 'NewsController@notice_index')->name('News.notice_index');
    // 矿池数据
    Route::get('ores', 'OrePoolController@index')->name('ores.index');
    // 同步矿池数据
    Route::post('ores', 'OrePoolController@store')->name('ores.store');
    // 分类
    Route::get('categories', 'CategoriesController@index')->name('categories.index');
    // 获取版本更新
    Route::get('version', 'VersionsController@version');
    // 获取当前版本信息
    Route::get('cat_version', 'VersionsController@cat');
    // 获取当前最新版本
    Route::get('best_version', 'VersionsController@best');
    // 获取站点配置
    Route::get('site', 'SiteController@show');
    // 获取用户注册协议隐私
    Route::get('register_agreements', 'AgreementsController@register');
    // 获取所有协议
    Route::get('agreements', 'AgreementsController@index');
    // 协议详情
    Route::get('agreements/{agreement}', 'AgreementsController@show');
    // 登录后可访问
    Route::middleware('auth:api')->group(function(){
        // 充币申请
        Route::get('recharges', 'RechargesController@store')->name('recharges.store');
        // 节流处理防止攻击
        // 下单
        Route::post('orders', 'OrdersController@store')
            ->middleware('throttle:3,1')
            ->name('orders.store');
        // 提交支付凭证
        Route::put('orders/prove', 'OrdersController@prove')
            ->middleware('throttle:4,1')
            ->name('orders.prove');
        // 申请提货
        Route::put('apply_goods', 'OrdersController@apply_goods');
        // 确认支付，放货
        Route::put('release_goods', 'OrdersController@release_goods');
        // 订单统计
        Route::get('order_count', 'OrdersController@order_count');
        // 申请转卖
        Route::put('apply_sell', 'OrdersController@apply_sell');
        // 申请体验会员
        Route::put('apply', 'AuthorizationsController@apply_vip');
        // 更改资料
        Route::put('edit', 'AuthorizationsController@edit')->name('users.edit');
        // 实名认证
        Route::put('identity', 'AuthorizationsController@verificationIdentity')->name('Authorizations.identity');
        // 视频认证
        Route::put('identity_video', 'AuthorizationsController@verificationIdentityVideo');
        // 更改安全密码
        Route::put('safe_password', 'AuthorizationsController@safePassword')->name('Authorizations.safe_password');
        // 登录密码
        Route::put('password', 'AuthorizationsController@password')->name('Authorizations.password');
        // 获取当前用户信息
        Route::get('me', 'AuthorizationsController@me')->name('Authorizations.me');
        // 订单列表
        Route::get('orders', 'OrdersController@index')->name('orders.index');
        // 订单详情
        Route::get('orders/{order}', 'OrdersController@show')->name('orders.show');
        // 分享佣金
        Route::get('commissions', 'CommissionsController@index');
        // 设置分享佣金比例
        Route::put('rate', 'CommissionsController@rate');
//        // 申请列表
//        Route::get('recharges', 'RechargesController@index')->name('recharges.index');
        // 钱包列表
        Route::get('wallets', 'WalletsController@index')->name('wallets.index');
        // 用户邀请连接
        Route::get('invite', 'AuthorizationsController@invite')->name('invite.show');
        // 提币申请记录
        Route::get('withdrawals', 'WithdrawalsController@index')->name('withdrawals.index');
        // 我的团队
        Route::get('teams', 'AuthorizationsController@teams')->name('Authorizations.teams');
        // 收益记录
        Route::get('logs', 'PowerDistributeLogsController@index')->name('logs.index');
        // 收益信息
        Route::get('logs/info', 'PowerDistributeLogsController@info')->name('logs.info');
        // 有效算力
        Route::get('powers', 'PowersController@index')->name('powers.index');
        // 查看分期详情
        Route::get('installments/{id}', 'InstallmentController@show')->name('installments.show');
        // 上传支付凭证
        Route::put('installments/pay_prove', 'InstallmentController@pay_prove')->name('installments.pay_prove');
        // 地址簿
        Route::resource('address_books', AddressBookController::class);
        // 获取支付方式数量
        Route::get('amount', 'PayMethodController@amount');
        // 获取账单明细
        Route::get('asset_details', 'AssetDetailsController@index');
        // 获取收款信息
        Route::get('collections', 'CollectionController@show');
        // 更新收款信息
        Route::put('collections', 'CollectionController@update');
        // 收货地址
        Route::resource('user_addresses', UserAddressesController::class);
        // 保证金
        Route::get('bond', 'BondController@bond');
        Route::post('bond', 'BondController@pay_bond');
    });
    // 实名认证后可访问
    Route::middleware(['auth:api', 'real'])->group(function(){
        // 节流处理防止攻击
        Route::middleware('throttle:1,1')->group(function (){
            // 提币申请
            Route::post('withdrawals', 'WithdrawalsController@store')
                ->name('withdrawals.store');
        });
    });

});

