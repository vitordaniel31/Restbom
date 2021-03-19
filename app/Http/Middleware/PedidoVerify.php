<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class PedidoVerify
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
        if(Auth::check()){
            if (Auth::user()->tipo_perfil== 1 or Auth::user()->tipo_perfil==4) {
                return $next($request);
            }
        }
        return redirect(RouteServiceProvider::HOME);
    }
}
