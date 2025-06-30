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
            $table->enum('category', ['روابط', 'تفاهنامه', 'SGA', 'اضافی فعالیتونه']);
            $table->string('title');
            $table->string('description');
            $table->string('file');
            $table->date('date');
            $table->string('report_frequency')->nullable();
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
