<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncentivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if (!Schema::hasTable('ovia_incentives')) {
            Schema::create('ovia_incentives', function (Blueprint $table) {
                $table->increments('id');
                $table->text('title');
                $table->text('decription');
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
        if (Schema::hasTable('ovia_incentives')) {
            Schema::drop('ovia_incentives');
        }
    }
}
