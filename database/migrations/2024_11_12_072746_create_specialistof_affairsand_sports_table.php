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
            $table->string('activity_title');
            $table->string('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('sports_teams');
            $table->string('sport_type');
            $table->string('baget');
            $table->string('activity_established_research_findings');
            $table->string('considerations');
            $table->string('content');

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
