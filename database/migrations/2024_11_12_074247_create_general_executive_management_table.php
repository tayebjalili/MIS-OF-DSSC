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
        Schema::create('general_executive_management', function (Blueprint $table) {




            // Job-related fields
            $table->id();
            $table->string('job_objective')->nullable();
            $table->string('description')->nullable();
            $table->string('day_report')->nullable();
            $table->string('report_file')->nullable();
            $table->string('monthly_plan')->nullable();
            $table->string('meeting_notes')->nullable();
            $table->string('correspondence_log')->nullable();
            $table->string('contact_info')->nullable();
            $table->string('additional_tasks')->nullable();
            $table->string('file')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_executive_management');
    }
};
