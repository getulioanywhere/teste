<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMidiasCompany extends Migration {

    //CRIA COLUNAS
    protected $table = 'company';

    public function up() {

        if (Schema::hasTable($this->table)) {
            if (!Schema::hasColumn($this->table, 'header', 'footer', 'seal_1', 'seal_2', 'seal_3')) {
                Schema::table($this->table, function (Blueprint $table) {
                    $table->string('header')->nullable();
                    $table->string('footer')->nullable();
                    $table->string('seal_1')->nullable();
                    $table->string('seal_2')->nullable();
                    $table->string('seal_3')->nullable();
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
