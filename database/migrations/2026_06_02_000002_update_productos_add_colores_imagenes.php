<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            // Multiple product colors (garment available colors): [{nombre:'Rojo', hex:'#FF0000'}, ...]
            $table->json('colores')->nullable()->after('badge_tipo');
            // Multiple product images: ['productos/xxx.jpg', ...]
            $table->json('imagenes')->nullable()->after('imagen');
            // Drop the old single-image column
            $table->dropColumn('imagen');
        });
    }

    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn(['colores', 'imagenes']);
            $table->string('imagen', 500)->nullable();
        });
    }
};
