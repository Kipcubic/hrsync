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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('address')->nullable();
            $table->string('staff_number')->unique()->nullable();
            $table->string('national_id')->unique()->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('country_id')->nullable();
            $table->string('ext_no')->nullable();
            $table->date('employment_date')->nullable();
            $table->date('dob')->nullable();
            $table->string('site_id')->nullable();
            $table->string('gender')->nullable();
            $table->integer('basic_salary')->default(0)->nullable();
            $table->string('acc_no')->nullable();
            $table->string('acc_name')->nullable();
            $table->string('currency')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('sort_code')->nullable();
            $table->string('bank_id')->nullable();
            $table->date('retirement_date')->nullable();
            $table->string('department_id')->nullable();
            $table->string('job_title')->nullable();
            $table->string('employment_type_id')->nullable();
            $table->string('head_of')->nullable();
            $table->boolean('terminated')->default(false);
            $table->string('reports_to')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('p_email')->unique()->nullable();
            $table->string('kra_pin')->unique()->nullable();
            $table->string('nssf_no')->unique()->nullable();
            $table->string('nhif_no')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('nssf_status')->default('false');
            $table->string('nhif_status')->default('false');
            $table->string('residence')->nullable();
            $table->string('location')->nullable();
            $table->string('location_id')->nullable();
            $table->string('type')->nullable();
            $table->string('nita_status')->nullable();
            $table->string('note')->nullable();
            $table->string('employee_id')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
