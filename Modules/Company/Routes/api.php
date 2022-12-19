<?php

use Illuminate\Http\Request;
use Modules\Company\Http\Controllers\ApiCompanyController;

Route::get('/company', [ApiCompanyController::class, 'index'])->middleware(['api', 'cors']);