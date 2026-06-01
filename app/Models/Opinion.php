<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    protected $table = 'opiniones';

    protected $fillable = ['nombre', 'email', 'valoracion', 'texto', 'trabajo_id', 'aprobada'];

    protected $casts = [
        'aprobada'   => 'boolean',
        'valoracion' => 'integer',
    ];

    public function trabajo()
    {
        return $this->belongsTo(Trabajo::class);
    }
}
