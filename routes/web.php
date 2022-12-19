<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Request;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */    
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'index')->name('login');
        Route::post('/auth', 'login')->name('access');
        Route::get('/logout', 'logout')->name('exit');
    });

    Route::group(['middleware' => 'auth'], function () {

        Route::get('/', function () {
            return view('dashboard', ['wildcard' => 'dashboard.dashboard']);
        })->name('dashboard');
        
        //rota para limpeza de caches sem necessidade de comando no terminal
        Route::get('/clear-cache', function () {
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('config:cache');
            Artisan::call('view:clear');
            Artisan::call('route:clear');
            return redirect()->back();
            // return redirect('/');
        });
        
        //rota para limpeza de caches sem necessidade de comando no terminal
        Route::get('/rebuild-menu', function () {
            Artisan::call('menu:make');
            return redirect()->back();
        });
        
        Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
    });
