<?php

namespace App\Http\Middleware;

use App\Classes\Logs;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class RoutesAccessedLog {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {
        //Registra em log as rotas acessadas pelo usuário logado
        //if (env('STOP_LOGS') !== false) {
            //Logs::log('routesaccess', 'Route Acessada: '.$request->getRequestUri().' - Idioma: '.App::getLocale(). ' - Usuário logado: '.Auth::user());
       // }
        return $next($request);
    }

}
 
        
        