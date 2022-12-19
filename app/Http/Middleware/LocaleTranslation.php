<?php
/*
 * Classe Middleware criada By MacGyver.
 * Responsável por controlar tipo de idoma na chamada pelo browser.
 * Executa $request->header('accept-language') 
 * que retorna uma string "pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7"
 * Pegando o primeiro valor do Array[0] e setando config/App em locale e fallback_locale
 * 
 * Não está automatizado TIME ZONE!
 * 
 * Utilizar nos arquivos de rotas
 * Route::group(['middleware' => 'locale'], function () {
 *  rotas da aplicação
 * });
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleTranslation {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {

        $explode = explode(',', $request->header('accept-language'));
        config(['app.locale' => $explode[0]]);
        config(['app.fallback_locale' => $explode[0]]);
        config(['app.timezone' => 'America/Sao_Paulo']);
        date_default_timezone_set(config('app.timezone'));

        App::setLocale($explode[0]);

        return $next($request);
    }

}
