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
        Schema::create('specialistof_affairsand_sports', function (Blueprint $table) {
            $table->id();
            $table->string('activity_name');
            $table->text('description');
            $table->date('activity_date');
            $table->string('team_name');
            $table->string('sport_type');
            $table->string('coach_name');
            $table->string('report_type'); // daily, weekly, monthly, yearly
            $table->text('content');
            $table->date('report_date');
            $table->string('file')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialistof_affairsand_sports');
    }
};
