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
        Schema::create('actors', function (Blueprint $table) {
            $table->increments('id'); // Campo autoincremental y clave primaria
            $table->string('name', 30);
            $table->string('surname',30);
            $table->date('birthdate');
            $table->string('country', 30);
            $table->string('img_url', 255);
            $table->timestamps(); // Crea automáticamente created_at y updated_at como timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('actors', function (Blueprint $table) {
            Schema::drop("actors");
            });
    }
};
