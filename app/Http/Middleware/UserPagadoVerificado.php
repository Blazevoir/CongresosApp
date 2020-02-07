<?php

namespace App\Http\Middleware;

use Closure;
use App\Pago;
use App\User;

class UserPagadoVerificado
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
        if(\App\Pago::where('iduser',Auth::user()->id)->first()->verificado != 1){
            redirect('ponencia');
        }
        
    }
}
