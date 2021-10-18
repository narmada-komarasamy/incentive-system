<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployerIncentiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ovia_employer_incentives')) {
            Schema::create('ovia_employer_incentives', function (Blueprint $table) {
                $table->integer('employer_id');
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
         if (Schema::hasTable('ovia_employer_incentives')) {
            Schema::drop('ovia_employer_incentives');
        }
    }
}
