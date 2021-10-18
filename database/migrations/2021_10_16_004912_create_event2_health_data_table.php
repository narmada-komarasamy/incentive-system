<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvent2HealthDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ovia_health_records')) {
            Schema::create('ovia_health_records', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->integer('mood_id');
                $table->integer('symptom_id');
                $table->datetime('date_created');
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
        if (Schema::hasTable('ovia_health_records')) {
            Schema::drop('ovia_health_records');
        }
    }
}
