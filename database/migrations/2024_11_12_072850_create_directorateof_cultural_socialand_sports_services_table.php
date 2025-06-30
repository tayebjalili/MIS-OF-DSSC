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
        Schema::create('directorateof_cultural_socialand_sports_services', function (Blueprint $table) {
            $table->id();
            $table->string('job_title');
            $table->string('location');
            $table->string('reports_to');
            $table->string('essential_notes');
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('directorateof_cultural_socialand_sports_services');
    }
};
