<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    protected $fillable = [
        'nombre',
        'apellidos',
        'telefono',
        'email',
        'donde_compro',
        'descripcion',
        'imagenes',
        'ip',
        'estado',
    ];

    protected $casts = [
        'imagenes' => 'array',
    ];

    // ── Helpers ────────────────────────────────────────────────────────────

    public static function estados(): array
    {
        return [
            'nueva'      => ['label' => 'Nueva',      'color' => '#DC2626', 'bg' => '#FEF2F2'],
            'en_proceso' => ['label' => 'En proceso',  'color' => '#D97706', 'bg' => '#FFFBEB'],
            'resuelta'   => ['label' => 'Resuelta',    'color' => '#166534', 'bg' => '#F0FDF4'],
        ];
    }

    public function estadoInfo(): array
    {
        return self::estados()[$this->estado] ?? self::estados()['nueva'];
    }
}
