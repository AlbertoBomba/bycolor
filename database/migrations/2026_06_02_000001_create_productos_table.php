<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 200);
            $table->text('descripcion')->nullable();
            $table->string('categoria', 50)->default('otros');
            $table->string('emoji', 10)->nullable();
            $table->string('color_inicio', 20)->nullable()->default('#FF5733');
            $table->string('color_fin', 20)->nullable()->default('#FF8C42');
            $table->string('precio_desde', 50)->nullable();
            $table->json('caracteristicas')->nullable();
            $table->string('badge', 100)->nullable();
            $table->string('badge_tipo', 50)->nullable()->default('badge-coral');
            $table->string('imagen', 500)->nullable();
            $table->boolean('destacado')->default(false);
            $table->boolean('activo')->default(true);
            $table->unsignedInteger('orden')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
