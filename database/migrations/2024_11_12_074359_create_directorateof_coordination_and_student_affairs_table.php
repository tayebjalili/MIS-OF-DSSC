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
        Schema::create('directorateof_coordination_and_student_affairs', function (Blueprint $table) {
            $table->id();
            $table->text('academic_institution_name')->nullable();
            $table->text('relevant_management_in_universities')->nullable();
            $table->text('creative_students_intro')->nullable();
            $table->text('cV_writing')->nullable();
            $table->text('new_students_orientation')->nullable();

            $table->text('honor_students_encouragement')->nullable();


            $table->text('short_term_courses_credits')->nullable();
            $table->text('disabled_students')->nullable();

            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('directorateof_coordination_and_student_affairs');
    }
};
