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
        Schema::create('directorateof_graduate_coordinationand_inter_sector_relations', function (Blueprint $table) {
            $table->id();
            $table->string('responsibility_type');
            $table->string('title');
            $table->text('description');
            $table->text('report_frequency');
            $table->text('report_file')->nullable();
            $table->string('file')->nullable();

            // Number or detailed list

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('directorateof_graduate_coordinationand_inter_sector_relations');
    }
};
