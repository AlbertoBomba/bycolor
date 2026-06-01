<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('opiniones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('email', 150)->nullable();
            $table->tinyInteger('valoracion')->default(5);
            $table->text('texto');
            $table->foreignId('trabajo_id')->nullable()->constrained('trabajos')->nullOnDelete();
            $table->boolean('aprobada')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opiniones');
    }
};
