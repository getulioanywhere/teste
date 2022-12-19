<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        config()->set('translatable.use_fallback', false);

        if (isset($this->wildcard)) {
            view()->share('wildcard', $this->wildcard);
            view()->share('module', $this->module);
        }
    }
}
