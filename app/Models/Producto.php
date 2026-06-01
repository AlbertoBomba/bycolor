<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'nombre', 'descripcion', 'categoria',
        'emoji', 'color_inicio', 'color_fin',
        'precio_desde', 'caracteristicas', 'colores', 'imagenes',
        'badge', 'badge_tipo', 'destacado', 'activo', 'orden',
    ];

    protected $casts = [
        'caracteristicas' => 'array',
        'colores'         => 'array',
        'imagenes'        => 'array',
        'destacado'       => 'boolean',
        'activo'          => 'boolean',
        'orden'           => 'integer',
    ];

    const CATEGORIAS = [
        'ropa_trabajo'   => 'Ropa de trabajo',
        'ropa_deportiva' => 'Ropa deportiva',
        'eventos'        => 'Eventos',
        'complementos'   => 'Complementos',
        'otros'          => 'Otros',
    ];

    const BADGE_TIPOS = [
        'badge-coral' => 'Coral',
        'badge-navy'  => 'Navy',
        'badge-mint'  => 'Mint',
        'badge-gold'  => 'Gold',
    ];

    public function getNombreCategoriaAttribute(): string
    {
        return self::CATEGORIAS[$this->categoria] ?? ucfirst($this->categoria);
    }

    public function getColorGradienteAttribute(): string
    {
        return ($this->color_inicio ?: '#FF5733') . ',' . ($this->color_fin ?: '#FF8C42');
    }

    public function getUrlImagenAttribute(): ?string
    {
        if ($this->imagenes && count($this->imagenes) > 0) {
            return asset('storage/' . $this->imagenes[0]);
        }
        return null;
    }

    public function getUrlImagenesAttribute(): array
    {
        if (!$this->imagenes) return [];
        return array_map(fn($p) => asset('storage/' . $p), $this->imagenes);
    }
}
