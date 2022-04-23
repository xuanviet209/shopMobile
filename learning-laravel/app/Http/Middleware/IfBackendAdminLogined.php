<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IfBackendAdminLogined
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
        if(!empty($request->session()->get('adminUsername'))){
            //đã login r : mặc định luôn luôn vào dashboard
            return redirect()->route('admin.dashboard');
        }
        return $next($request);
    }
}
