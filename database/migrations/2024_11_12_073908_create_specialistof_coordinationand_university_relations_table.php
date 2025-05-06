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
        Schema::create('specialistof_coordinationand_university_relations', function (Blueprint $table) {
            $table->id();
            $table->string('activity_name');
            $table->date('activity_date');
            $table->string('report_type');
            $table->text('description');
            $table->string('department')->nullable();
            $table->string('file')->nullable(); // For file uploads (PDF, DOCX, Excel)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialistof_coordinationand_university_relations');
    }
};
