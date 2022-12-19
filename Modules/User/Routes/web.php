<?php

Route::group(['middleware' => ['auth']], function () {
    Route::controller(UserController::class)->group(function () {
        $module = 'user';//NAME MODULE        
        $table = '.routes.table.';
        $show = '.routes.show.';
        $update = '.routes.update.';
        $destroy = '.routes.destroy.';
        $new = '.routes.new.';
        $create = '.routes.create.';
        $url = 'url';
        $name = 'name';
        
        Route::get(config($module . $table . $url), 'index')
                ->name(config($module . $table . $name));
        
        Route::get(config($module . $show . $url) . '{id}', 'show')
                ->name(config($module . $show . $name));
        
        Route::post(config($module . $update . $url) . '{id}', 'update')
                ->name(config($module . $update . $name));
        
        Route::post(config($module . $destroy . $url) . '{id}', 'destroy')
                ->name(config($module . $destroy . $name));
        
        Route::get(config($module . $new . $url), 'show')
                ->name(config($module . $new . $name));
        
        Route::post(config($module . $create . $url), 'create')
                ->name(config($module . $create . $name));
    });
});
