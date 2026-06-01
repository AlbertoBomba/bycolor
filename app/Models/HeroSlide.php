<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    protected $table = 'hero_slides';

    protected $fillable = [
        'titulo', 'subtitulo', 'texto_boton', 'url_boton',
        'tipo_media', 'ruta_media', 'orden', 'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'orden'  => 'integer',
    ];
}
