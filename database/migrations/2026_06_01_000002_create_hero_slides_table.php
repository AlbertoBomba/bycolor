<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 200)->nullable();
            $table->string('subtitulo', 500)->nullable();
            $table->string('texto_boton', 100)->nullable();
            $table->string('url_boton', 500)->nullable();
            $table->enum('tipo_media', ['imagen', 'video'])->default('imagen');
            $table->string('ruta_media', 500);
            $table->unsignedInteger('orden')->default(0);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_slides');
    }
};
