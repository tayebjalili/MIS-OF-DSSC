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
        Schema::create('managementof_practical_workin_natural_sciencesand_sciences', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('father_name')->nullable();
            $table->string('field_of_study');
            $table->string('university');
            $table->string('internship_organization');
            $table->string('internship_duration');
            $table->string('internship_type');
            $table->string('research_topic');
            $table->year('graduation_year');
            $table->string('file')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('managementof_practical_workin_natural_sciencesand_sciences');
    }
};
