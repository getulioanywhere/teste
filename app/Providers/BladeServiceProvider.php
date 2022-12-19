<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;

class BladeServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Blade::directive('datetime', function ($expression) {
            return "<?php echo ($expression)->format(trans('locale.datetime')) ?>";
        });

        Blade::directive('date', function ($expression) {
            return "<?php echo ($expression)->format(trans('locale.date')) ?>";
        });

        Blade::if('dev', function ($pass = true) {
            $whitelist = ['127.0.0.1', '::1', 'localhost'];
            return (env('APP_ENV') === 'local' && in_array($_SERVER['REMOTE_ADDR'], $whitelist)) || env('APP_DEBUG') === true;
        });
    }

}