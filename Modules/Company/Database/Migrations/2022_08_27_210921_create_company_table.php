<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration {

    //CRIA TABELA
    protected $table = 'company';

    public function up() {

        if (!Schema::hasTable($this->table)) {
            Schema::create($this->table, function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->date('foundation')->comment('Data de criação da empresa');
                $table->string('email');
                $table->string('phone');
                $table->string('facebook')->nullable();
                $table->string('instagram')->nullable();
                $table->string('whatsapp_1');
                $table->string('whatsapp_2')->nullable();
                $table->string('twitter')->nullable();
                $table->string('youtube')->nullable();
                $table->string('linkedin')->nullable();
                $table->string('address_street');
                $table->string('address_number')->nullable();
                $table->string('address_neighborhood');
                $table->string('address_city');
                $table->string('address_state');
                $table->string('address_zipcod')->nullable();
                $table->string('opening_hours')->nullable()->comment('Horario de atendimento');
                $table->string('map')->nullable()->comment('Google maps');
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
