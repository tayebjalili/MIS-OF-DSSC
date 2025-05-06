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
        Schema::create('specialistof_graduate_relations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('father_name')->nullable();
            $table->string('university');
            $table->string('faculty');
            $table->string('department');
            $table->string('grades'); // Change back to string if grades are letters like 'A', 'B', etc.
            $table->decimal('percentage', 5, 2);
            $table->year('year');
            $table->decimal('final_percentage', 5, 2)->nullable(); // Allow null if not provided
            $table->string('phone_number')->nullable(); // Allow nullable phone number
            $table->string('photo')->nullable(); // Allow nullable for storing photo file path
            $table->string('looks')->nullable(); // Nullable if not always provided
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialistof_graduate_relations');
    }
};
