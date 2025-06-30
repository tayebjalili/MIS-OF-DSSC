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
        Schema::create('managementof_relationswith_sectoral_agencies', function (Blueprint $table) {
            $table->id();

            $table->string('sector_name');
            $table->string('title');
            $table->string('partner_institution');
            $table->string('description');
            $table->date('date_signed');
            $table->string('report_type'); // daily, weekly, monthly, yearly

            $table->date('report_date');
            $table->string('file')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('managementof_relationswith_sectoral_agencies');
    }
};
