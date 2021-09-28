<?php

namespace App\Http\Middleware;

use App\Exceptions\InternalException;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class RealNameMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->status !== User::STATUS_SUCCESS)
            throw new  InternalException('请先完成实名认证');

        return $next($request);
    }
}
