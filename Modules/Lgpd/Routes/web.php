<?php
Route::group(['middleware' => ['auth']], function () {
    Route::controller(LgpdController::class)->group(function () {
        $module = 'lgpd';
        Route::get(config($module . '.routes.table.url'), 'index')->name(config($module . '.routes.table.name'));
        
    });
    
    Route::controller(LgpdPageController::class)->group(function () {
        $module = 'lgpd';        
        Route::get(config($module . '.routes.show.url') . '{id}', 'show')->name(config($module . '.routes.show.name'));
        Route::post(config($module . '.routes.update.url') . '{id}', 'update')->name(config($module . '.routes.update.name'));
        //Route::post(config($module . '.routes.destroy.url') . '{id}', 'destroy')->name(config($module . '.routes.destroy.name'));
        //Route::get(config($module . '.routes.new.url'), 'show')->name(config($module . '.routes.new.name'));
        //Route::post(config($module . '.routes.create.url'), 'create')->name(config($module . '.routes.create.name'));
    });
    
    
});