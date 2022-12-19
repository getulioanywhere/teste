<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordResetsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $table = 'password_resets';
    
    public function up() {
        if (!Schema::hasTable($this->table)) {
            Schema::create($this->table, function (Blueprint $table) {                
                $table->string('email')->index()->comment('');
                $table->string('token')->comment('');
                $table->timestamp('created_at')->nullable()->comment('');
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
