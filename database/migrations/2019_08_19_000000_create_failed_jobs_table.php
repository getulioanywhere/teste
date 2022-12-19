<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFailedJobsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $table = 'failed_jobs';

    public function up() {
        if (!Schema::hasTable($this->table)) {
            Schema::create($this->table, function (Blueprint $table) {
                $table->id()->comment('');
                $table->string('uuid')->unique()->comment('');
                $table->text('connection')->comment('');
                $table->text('queue')->comment('');
                $table->longText('payload')->comment('');
                $table->longText('exception')->comment('');
                $table->timestamp('failed_at')->useCurrent()->comment('');
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
