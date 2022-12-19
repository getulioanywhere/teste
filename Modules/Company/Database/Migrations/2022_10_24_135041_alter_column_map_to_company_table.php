<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnMapToCompanyTable extends Migration {

    //MODIFICA COLUNA
    protected $table = 'company';

    public function up() {

        if (Schema::hasTable($this->table)) {
            if (Schema::hasColumn($this->table, 'map')) {
                Schema::table($this->table, function (Blueprint $table) {
                    $table->text('map')->change();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        
    }

}
