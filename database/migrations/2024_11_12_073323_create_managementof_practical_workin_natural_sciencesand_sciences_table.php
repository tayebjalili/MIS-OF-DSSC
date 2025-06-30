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
            $table->string('field_of_study')->nullable();
            $table->string('university');
            $table->string('internship_organization');
            $table->date('internship_duration');
            $table->date('internship_type');
            $table->string('research_topic');
            $table->string('graduation_year');
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
