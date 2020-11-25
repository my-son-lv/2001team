<?php

namespace App\Http\Middleware;

use Closure;

class CheckSallerLogin
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
        $saller_info = session('saller_info');
        if($saller_info==""){
            return redirect('/saller/login');
        }
//        dd(123123);
        return $next($request);
    }
}
