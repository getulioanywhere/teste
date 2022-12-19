<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttrPathToCompanyTable extends Migration {

    //CRIA COLUNAS
    protected $table = 'company';

    public function up() {

        if (Schema::hasTable($this->table)) {
            if (!Schema::hasColumn($this->table, 'path_header', 'path_footer', 'path_seal_1', 'path_seal_2', 'path_seal_3')) {
                Schema::table($this->table, function (Blueprint $table) {

                    $table->string('path_header')
                            ->default('')
                            ->comment('Caminho da imagem salva no padrão automático da classe functions')
                            ->after('header');
                    $table->string('path_footer')
                            ->default('')
                            ->comment('Caminho da imagem salva no padrão automático da classe functions')
                            ->after('footer');
                    $table->string('path_seal_1')
                            ->default('')
                            ->comment('Caminho da imagem salva no padrão automático da classe functions')
                            ->after('seal_1');
                    $table->string('path_seal_2')
                            ->default('')
                            ->comment('Caminho da imagem salva no padrão automático da classe functions')
                            ->after('seal_2');
                    $table->string('path_seal_3')
                            ->default('')
                            ->comment('Caminho da imagem salva no padrão automático da classe functions')
                            ->after('seal_3');
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
