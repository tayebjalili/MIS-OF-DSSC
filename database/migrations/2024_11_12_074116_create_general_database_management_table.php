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
        Schema::create('general_database_management', function (Blueprint $table) {
            $table->id();
            $table->enum('meeting_type', ['شورای معینیت علمی', 'شورای رهبریت علمی']);
            $table->integer('meeting_number');
            $table->date('meeting_date');
            $table->text('description')->nullable();
            $table->json('agenda_items');
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_database_management');
    }
};
