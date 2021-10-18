<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvent1BirthRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ovia_birth_records')) {
            Schema::create('ovia_birth_records', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->text('gender');
                $table->datetime('birth_date');
                $table->text('hospital');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('ovia_birth_records')) {
            Schema::drop('ovia_birth_records');
        }
    }
}
