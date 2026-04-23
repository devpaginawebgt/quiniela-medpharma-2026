<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'imagen',
        'codigo_iso',
        'descripcion',
        'grupo',
        'goles_favor',
        'goles_contra',
        'partidos_jugados',
        'partidos_ganados',
        'partidos_perdidos',
        'partidos_empatados',
        'has_white_flag',
        'puntos',
    ];

    protected function casts() {
        return ['has_white_flag' => 'boolean'];
    }

    public function partidos($jornada)
    {
        return $this->belongsToMany(Partido::class,'equipo_partidos');
    }
}
