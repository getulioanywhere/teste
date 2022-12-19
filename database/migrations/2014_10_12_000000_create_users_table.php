<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

    protected $table = 'users';

    public function up() {

        if (!Schema::hasTable($this->table)) {
            Schema::create($this->table, function (Blueprint $table) {
                $table->id()->comment('');
                $table->string('name')->comment('');
                $table->string('email')->unique()->comment('');
                $table->timestamp('email_verified_at')->nullable()->comment('');
                $table->string('password')->comment('');

                $table->boolean('active')->default(true)->comment('');
                $table->boolean('super_user')->default(false)->comment('');
                $table->string('avatar')->default('')->comment('');

                $table->rememberToken()->comment('');
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

        if (Schema::hasTable($this->table)) {
            Schema::dropIfExists($this->table);
        }
    }

}
