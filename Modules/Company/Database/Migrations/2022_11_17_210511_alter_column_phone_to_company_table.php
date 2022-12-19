<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnPhoneToCompanyTable extends Migration {

    //MODIFICA COLUNAS
    protected $table = 'company';

    public function up() {

        if (Schema::hasTable($this->table)) {
            if (Schema::hasColumn($this->table, 'email', 'phone', 'whatsapp_1',
                            'address_street', 'address_neighborhood', 'address_city',
                            'address_state')) {
                Schema::table($this->table, function (Blueprint $table) {
                    $table->string('email')->nullable()->change();
                    $table->string('phone')->nullable()->change();
                    $table->string('whatsapp_1')->nullable()->change();
                    $table->string('address_street')->nullable()->change();
                    $table->string('address_neighborhood')->nullable()->change();
                    $table->string('address_city')->nullable()->change();
                    $table->string('address_state')->nullable()->change();
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
