<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveDayHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('leave_day_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leave_day_id');
            $table->integer('previous_days');
            $table->integer('updated_days');
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('leave_day_id')->references('id')->on('leave_days')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('leave_day_histories');
    }
}
