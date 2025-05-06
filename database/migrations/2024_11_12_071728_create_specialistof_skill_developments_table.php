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
            $table->string('title');
            $table->text('type');
            $table->text('description');
            $table->text('day_report');
            $table->text('weakly_report');
            $table->text('monthly_report');
            $table->text('year_report');
            $table->string('file')->nullable();
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
