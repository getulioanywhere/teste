<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPathTableUsers extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::hasColumn('users', 'path')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('path')
                        ->default('')
                        ->comment('Caminho da imagem salva no padrão automático da classe functions')
                        ->after('avatar');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        if (Schema::hasColumn('users', 'path')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('path');
            });
        }
    }

}
