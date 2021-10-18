<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserIncentiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ovia_user_incentives')) {
            Schema::create('ovia_user_incentives', function (Blueprint $table) {
                $table->integer('user_id');
                $table->integer('incentive_id');
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
         if (Schema::hasTable('ovia_user_incentives')) {
            Schema::drop('ovia_user_incentives');
        }
    }
}
