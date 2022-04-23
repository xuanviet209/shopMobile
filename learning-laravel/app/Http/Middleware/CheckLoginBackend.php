<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLoginBackend
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$params = null)
    {
        //$params : tham số của middleware
        if($params === 'admin'){
            // chạy vượt qua middle - xử lý tiếp các routing
            return $next($request);
        }
        return redirect(route('be.login'));  
    }
}
