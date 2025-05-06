<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // The name of the permission
            $table->string('groupby'); // The group the permission belongs to
            $table->timestamps(); // This will create `created_at` and `updated_at` columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
