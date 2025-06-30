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
        Schema::create('employment_specialists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('father_name'); // Fixed spelling
            $table->string('id_canqor'); // Changed to 'id_canqor'
            $table->string('province'); // Fixed spelling
            $table->string('university');
            $table->string('faculty');
            $table->string('department');
            $table->string('organization');
            $table->string('graduated_year'); // Fixed spacing
            $table->decimal('percentage', 5, 2); // Assuming percentage can have decimals
            $table->string('email');
            $table->string('phone_number'); // Fixed spacing
            $table->string('file')->nullable(); // Assuming file is a string

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_specialists');
    }
};
