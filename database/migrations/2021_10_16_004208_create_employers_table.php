<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ovia_employers')) {
            Schema::create('ovia_employers', function (Blueprint $table) {
                $table->increments('id');
                $table->text('name');
                $table->text('address');
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
        if (Schema::hasTable('ovia_employers')) {
            Schema::drop('ovia_employers');
        }
    }
}
