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
        Schema::create('general_managementof_counseling_services', function (Blueprint $table) {
            $table->id();
            $table->string('job_type'); // e.g., psychological, career, practical work, etc.
            $table->text('description');
            $table->string('student_name');
            $table->string('faculty');
            $table->string('internship_company');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('report_type'); // daily, weekly, monthly, yearly
            $table->text('content');
            $table->date('report_date');
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_managementof_counseling_services');
    }
};
