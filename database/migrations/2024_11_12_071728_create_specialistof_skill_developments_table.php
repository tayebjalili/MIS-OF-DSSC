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
        Schema::create('specialistof_skill_developments', function (Blueprint $table) {
            $table->id();

            // Inventor-specific fields
            $table->string('student_name');
            $table->string('father_name');
            $table->string('university');
            $table->string('faculty');
            $table->string('national_id');
            $table->string('invention_type');
            $table->string('invention_place');
            $table->string('expense')->nullable(); // Cost of the invention/project
            $table->string('completion_status'); // e.g., Completed or Not Completed
            $table->string('incompletion_reason')->nullable(); // If not completed, why?

            $table->string('file')->nullable(); // Optional file upload (like project file/report)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialistof_skill_developments');
    }
};
