<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('Illuminate\Pagination\LengthAwarePaginator',function ($app,$options){
            return new \App\Services\Common\LengthAwarePaginatorService($options['items'], $options['total'], $options['perPage'], $options['currentPage'] , $options['options']);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        \App\Models\PowerDistributeLog::observe(\App\Observers\PowerDistributeLogObserver::class);
        \App\Models\Recharge::observe(\App\Observers\RechargeObserver::class);
        \App\Models\Withdrawal::observe(\App\Observers\WithdrawalObserver::class);
        \App\Models\LoanDetailed::observe(\App\Observers\LoanDetailedObserver::class);
        \App\Models\User::observe(\App\Observers\UserObserver::class);
        \App\Models\Order::observe(\App\Observers\OrderObserver::class);
    }
}
