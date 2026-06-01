<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrabajoImagen extends Model
{
    protected $table = 'trabajo_imagenes';

    protected $fillable = ['trabajo_id', 'ruta', 'orden'];

    public function trabajo()
    {
        return $this->belongsTo(Trabajo::class);
    }

    public function getRutaUrlAttribute(): string
    {
        return asset('storage/' . $this->ruta);
    }
}
