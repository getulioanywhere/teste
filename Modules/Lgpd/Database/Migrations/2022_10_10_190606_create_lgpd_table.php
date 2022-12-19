<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLgpdTable extends Migration {

     //CRIA TABELA
    protected $table = 'lgpd';

    public function up() {
        if (!Schema::hasTable($this->table)) {
            Schema::create($this->table, function (Blueprint $table) {
                $table->id('id');
                $table->tinyInteger('page_active')->default(1);
                
                $table->string('page_title', 200)->default('');
                $table->longText('page_body')->nullable();
                $table->string('slug', 150)->default('');
              
                $table->string('modal_title')->default('');
                $table->text('modal_body')->nullable();

                $table->string('seo_title')->default('');
                $table->text('seo_description')->nullable();
                $table->string('seo_keywords', 500)->default('');
                
                $table->string('locale', 20)->default('pt-BR');
                
                $table->timestamps();
            });
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
