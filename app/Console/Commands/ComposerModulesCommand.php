<?php

namespace App\Console\Commands;

use App\Classes\Functions;
use Illuminate\Console\Command;

class ComposerModulesCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'composer:module {option}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $functions = new Functions();
        $array = $functions->server();
        $php = $array['php'];
        $composer = $array['composer'];

        $array_module = config('modules_registers.path');
        if (isset($array_module)) {
            for ($i = 0; $i < count($array_module); $i++) {
                $moduleName = $array_module[$i];
                echo $moduleName . PHP_EOL;               

                system($composer . ' ' . $this->argument('option') . ' --working-dir=' . $moduleName);
                //echo 'Publish module' . PHP_EOL;
                //system($php . ' artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider"');
            }
        }
    }

}
