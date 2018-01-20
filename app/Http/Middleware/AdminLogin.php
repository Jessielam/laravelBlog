<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** 判断用户是否已经登录 */
        if(!session('user')) {
            return redirect('admin/login');
        }
        return $next($request);
    }
}
