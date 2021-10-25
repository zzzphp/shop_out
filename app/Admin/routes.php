<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('users', UsersController::class);
    $router->resource('news', NewsController::class);
    $router->resource('currencies', CurrenciesController::class);
    $router->resource('products', ProductsController::class);
    $router->any('upload/files', 'FileController@handle');
    $router->resource('orders', OrdersController::class);
    $router->resource('recharges', RechargesController::class);
    $router->resource('commissions', CommissionController::class);
    $router->resource('distributes', DistributeController::class);
    $router->resource('withdrawals', WithdrawalController::class);
    $router->resource('carousels', CarouselController::class);
    $router->resource('stages', StageController::class);
    $router->resource('power_distributes', PowerDistributeController::class);
    $router->resource('allies', AllyController::class);
    $router->resource('logs', PowerDistributeLogController::class);
    $router->resource('agents', AgentController::class);
    $router->resource('categories', CategoryController::class);
    $router->get('children', 'CategoryController@children');
    $router->resource('agent_statistics', AgentStatisticController::class);
    $router->resource('asset_details', AssetDetailController::class);
    $router->resource('agreements', AgreementController::class);
    $router->resource('installment_items', InstallmentItemController::class);
    $router->resource('pay_methods', PayMethodController::class);
    $router->resource('powers', PowerController::class);
    $router->resource('loans', LoanController::class);
    $router->resource('market_biki', CurrencyMarketBikiController::class);
    $router->resource('automatics', DistributesAutomaticController::class);
    $router->resource('versions', VersionController::class);
    $router->resource('information', NewsInformationController::class);
    $router->resource('real_names', UserRealNameController::class);
    $router->resource('shops', ShopController::class);

    $router->resource('admin_user', AdminUserController::class);
});
