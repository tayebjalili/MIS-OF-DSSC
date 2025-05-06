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
        Schema::create('employment_specialists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('father_name')->nullable();
            $table->string('orientation_notes')->nullable(); // New field
            $table->string('contracts_signed_with')->nullable(); // New field
            $table->string('students_referred_for_jobs')->nullable(); // New field
            $table->string('training_sessions')->nullable(); // New field
            $table->string('partner_organizations')->nullable(); // New field
            $table->string('monthly_report')->nullable(); // New field
            $table->string('phone_number')->nullable();
            $table->string('file')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_specialists');
    }
};
