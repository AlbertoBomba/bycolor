<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    protected $fillable = [
        'titulo', 'descripcion', 'categoria', 'imagen', 'fecha_realizacion', 'destacado',
    ];

    protected $casts = [
        'fecha_realizacion' => 'date',
        'destacado'         => 'boolean',
    ];

    public function imagenes()
    {
        return $this->hasMany(TrabajoImagen::class)->orderBy('orden');
    }

    public function getImagenUrlAttribute(): string
    {
        // Use gallery first, fall back to legacy single-image column
        $primera = $this->relationLoaded('imagenes')
            ? $this->imagenes->first()
            : $this->imagenes()->first();

        if ($primera) return asset('storage/' . $primera->ruta);
        if ($this->imagen) return asset('storage/' . $this->imagen);
        return asset('images/no-image.png');
    }

    public static function listaCategorias(): array
    {
        return [
            'camiseta'  => 'Camiseta',
            'polo'      => 'Polo',
            'sudadera'  => 'Sudadera',
            'sport'     => 'Deporte',
            'uniforme'  => 'Uniforme',
            'otro'      => 'Otro',
        ];
    }
}
