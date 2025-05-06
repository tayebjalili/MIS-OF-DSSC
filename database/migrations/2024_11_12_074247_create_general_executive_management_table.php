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
            $table->text('job_objective')->nullable();
            $table->text('description')->nullable();
            $table->date('day_report')->nullable();
            $table->string('report_file')->nullable();
            $table->text('monthly_plan')->nullable();
            $table->text('meeting_notes')->nullable();
            $table->text('correspondence_log')->nullable();
            $table->text('contact_info')->nullable();
            $table->text('additional_tasks')->nullable();
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
