<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalAccessTokensTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $table = 'personal_access_tokens';

    public function up() {
        if (!Schema::hasTable($this->table)) {
            Schema::create($this->table, function (Blueprint $table) {
                $table->id()->comment('');
                $table->morphs('tokenable');
                $table->string('name')->comment('');
                $table->string('token', 64)->unique()->comment('');
                $table->text('abilities')->nullable()->comment('');
                $table->timestamp('last_used_at')->nullable()->comment('');
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
