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
        Schema::create('mental_health_specialists', function (Blueprint $table) {
            $table->id();
            $table->string('job_title');
            $table->string('department');
            $table->date('location');
            $table->text('problem');
            $table->text('instructor');
            $table->text('duration');
            $table->text('result');
            $table->string('patient_intro');
            $table->string('education');
            $table->string('file')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mental_health_specialists');
    }
};
