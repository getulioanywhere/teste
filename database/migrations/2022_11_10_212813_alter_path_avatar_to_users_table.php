<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPathAvatarToUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (Schema::hasTable('users')) {
            if (Schema::hasColumn('users', 'path')) {
                Schema::table('users', function (Blueprint $table) {
                    if (!Schema::hasColumn('users','path_avatar')) {
                        $table->renameColumn('path', 'path_avatar');
                    }
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
