<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttrCnpjToCompanyTable extends Migration {

    //CRIA COLUNA
    protected $table = 'company';

    public function up() {

        if (Schema::hasTable($this->table)) {
            if (!Schema::hasColumn($this->table, 'cnpj')) {
                Schema::table($this->table, function (Blueprint $table) {
                    $table->string('cnpj')
                            ->default('')
                            ->comment('CNPJ da empresa responsável pelo site ou sistema')
                            ->after('id');
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
