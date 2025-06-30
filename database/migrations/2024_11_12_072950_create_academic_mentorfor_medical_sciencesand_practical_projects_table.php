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
        Schema::create('academic_mentorfor_medical_sciencesand_practical_projects', function (Blueprint $table) {
            $table->id();
            $table->string('job_type'); // e.g., psychological, career, practical work, etc.
            $table->string('description');
            $table->string('student_name');
            $table->string('father_name');
            $table->string('university_name');
            $table->string('faculty');
            $table->string('internship_company');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('job_time', ['Part-Time', 'Full-Time']);
            $table->string('report_type'); // daily, weekly, monthly, yearly
            $table->string('content');
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
        Schema::dropIfExists('academic_mentorfor_medical_sciencesand_practical_projects');
    }
};
