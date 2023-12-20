<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_days', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('leave_type');
            $table->integer('days')->default(0);
            $table->year('year');
            $table->unique(['user_id', 'year']);
            $table->string('last_accrued_month')->nullable();

            // Maximum Rollover days
            $table->integer('maximum_rollover_days')->default(0);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_days');
    }
}
