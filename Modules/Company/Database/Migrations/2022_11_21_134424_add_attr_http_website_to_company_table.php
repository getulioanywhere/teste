<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttrHttpWebsiteToCompanyTable extends Migration {

    //CRIA COLUNA
    protected $table = 'company';

    public function up() {

        if (Schema::hasTable($this->table)) {
            if (!Schema::hasColumn($this->table, 'http_website')) {
                Schema::table($this->table, function (Blueprint $table) {

                    $table->string('http_website')
                            ->default('')
                            ->comment('Coluna para armazenar o link do endpoint a ser usada para enviar os dados para gravar os arquivos em cache no web-client');
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
