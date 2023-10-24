<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('leave_type_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('comment')->nullable();
            $table->boolean('status')->default(false);
            $table->integer('duration')->unsigned()->nullable();
            $table->string('approver_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
