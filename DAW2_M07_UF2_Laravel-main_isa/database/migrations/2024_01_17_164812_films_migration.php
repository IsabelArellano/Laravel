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
          Schema::create('films', function (Blueprint $table) {
            $table->increments('id'); // Campo autoincremental y clave primaria
            $table->string('name', 100);
            $table->integer('year');
            $table->string('genre', 50);
            $table->string('country', 30);
            $table->integer('duration');
            $table->string('img_url', 255);
            $table->timestamps(); // Crea automáticamente created_at y updated_at como timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('films', function (Blueprint $table) {
            Schema::drop("films");
            });
            
    }
};
