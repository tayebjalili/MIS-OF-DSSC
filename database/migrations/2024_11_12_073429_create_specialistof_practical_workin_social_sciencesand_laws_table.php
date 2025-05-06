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
        Schema::create('specialistof_practical_workin_social_sciencesand_laws', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('faculty'); // Law, Journalism, Economics, etc.
            $table->date('date');
            $table->text('report_type');
            $table->text('description');
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialistof_practical_workin_social_sciencesand_laws');
    }
};
