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
            $table->text('location');
            $table->date('reports_to');
            $table->date('position_code');
            $table->text('date_of_review');
            $table->string('qualifications');
            $table->date('skills');
            $table->string('additional_notes');
            $table->string('file');
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
