<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\MenuSystem\Http\Controllers;

class MenuModulesCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'menu:make';

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
        $menu = new Controllers\MenuSystemController();
        $menu->create();
    }

}
