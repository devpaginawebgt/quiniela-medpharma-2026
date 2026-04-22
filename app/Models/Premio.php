<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Premio extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'posicion',
        'titulo_posicion',
        'nombre',
        'imagen',
        'pais_id',
    ];

    
}
