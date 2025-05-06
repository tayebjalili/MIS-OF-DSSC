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
            $table->string('title');
            $table->text('objective')->nullable();
            $table->text('specialized_duties')->nullable();
            $table->text('managerial_duties')->nullable();
            $table->text('coordination_duties')->nullable();
            $table->text('summary')->nullable();
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
