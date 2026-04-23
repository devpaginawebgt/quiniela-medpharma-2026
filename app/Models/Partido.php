<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Partido extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
       'fase',
       'jornada_id',
       'fecha_partido',
       'estadio_id',
       'brand_id',
       'jugado',
       'estado',
    ];

    protected function casts(): array
    {
        return [ 'fecha_partido' => 'datetime' ];
    }

    public function puntos(): HasOne
    {
        return $this->hasOne(PartidoPuntos::class, 'partido_id');
    }

    // public function brand(): BelongsTo
    // {
    //     return $this->belongsTo(Brand::class, 'brand_id');
    // }

}
