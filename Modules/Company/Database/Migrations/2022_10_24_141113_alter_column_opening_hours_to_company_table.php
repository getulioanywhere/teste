<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnOpeningHoursToCompanyTable extends Migration {

    //MODIFICA COLUNA
    protected $table = 'company';

    public function up() {

        if (Schema::hasTable($this->table)) {
            if (Schema::hasColumn($this->table, 'opening_hours')) {
                Schema::table($this->table, function (Blueprint $table) {
                    $table->text('opening_hours')->change();
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
