<?php

namespace App\Providers;

use App\Classes\DataReturn;
use App\Classes\Functions;
use App\Classes\Menus;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\ServiceProvider;
use Modules\Company\Models\Company;

class AppServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        /*$this->app->bind('App\Classes\Menus', function ($app) {
            return new Menu();
        });
        //$this->app->alias('Menus', 'App\Classes\Menus');
        $this->app->bind('App\Classes\Logs', function ($app) {
            return new Logs();
        });
        $this->app->bind('App\Classes\DataReturn', function ($app) {
            return new DataReturn();
        });
        $this->app->bind('App\Classes\Functions', function ($app) {
            return new Functions();
        });
        $this->app->bind('App\Classes\ExportExcel', function ($app) {
            return new Functions();
        });
        $this->app->bind('App\Classes\DataTables', function ($app) {
            return new Functions();
        });*/
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Blade::directive('menu_horizontal', function () {
            return Menus::create_menu_horizontal();
        });
        Blade::directive('menu_main', function () {
            return Menus::create_menu_main();
        });

        Blade::directive('random', function () {
            return Functions::generateRandomString(['specialChars' => false, 'qtyCaraceters' => 20]);
        });

        Blade::directive('encrypt', function ($value) {
            return Crypt::encrypt($value);
        });

        Blade::directive('decrypt', function ($value) {
            return Crypt::decrypt($value);
        });
        Blade::directive('logo', function ($value) {
            $model = new Company();
            $ret = '';
            $logo = $model->select('path_header', 'path_seal_3')->first();
            if ($logo) {
                $logo = $logo->toArray();
                switch ($value) {
                    case 'logo':
                        $ret = $logo['path_header'];

                        break;
                    case 'favicon':
                        $ret = $logo['path_seal_3'];

                        break;

                    default:
                        $ret = '';
                        break;
                }
            }
            return trim($ret);
        });

//        Blade::directive('convertDate', function ($value) {
//            return Functions::convertDate($value);
//        });
    }

}
