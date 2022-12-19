<?php

use Illuminate\Http\Request;
use Modules\Lgpd\Http\Controllers\ApiLgpdController;

Route::get('/lgpd', [ApiLgpdController::class, 'index'])->middleware(['api', 'cors']);
Route::post('/lgpd/consents', [ApiLgpdController::class, 'consents'])->middleware(['api', 'cors']);