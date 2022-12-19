<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterColumnDataToLgpdConsentsTable extends Migration {

   //MODIFICA COLUNA
    protected $table = 'lgpd_consents';

    public function up() {
        if (Schema::hasTable($this->table)) {
            if (Schema::hasColumn($this->table, 'data')) {
                Schema::table($this->table, function (Blueprint $table) {
                    $table->date('data')->change()->nullable();
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
