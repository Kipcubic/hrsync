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
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gender');
            $table->string('days_accrued');
            $table->string('max_days_year');
            $table->string('max_days_carried');
            $table->string('accrual_registered_at');
            $table->string('max_negative_balance');
            $table->boolean('attachment');
            $table->boolean('off_days');
            $table->boolean('holidays');
            $table->boolean('weekends')->default(false);
            $table->boolean('accrues')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_types');
    }
};
