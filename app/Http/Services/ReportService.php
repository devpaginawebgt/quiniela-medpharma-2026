<?php

namespace App\Http\Services;

use App\Models\Preccion;
use App\Models\User;

class ReportService
{
    public function getUsuarios()
    {
        return User::with(['country'])
            ->select('users.*')
            ->orderBy('puntos', 'desc');
    }

    public function getPronosticos()
    {
        return Preccion::with([
            'user.country',
            'partido.jornada',
            'partido.equipos.equipoUno',
            'partido.equipos.equipoDos',
            'resultado',
        ])
            ->select('preccions.*')
            ->orderBy('preccions.created_at', 'desc');
    }
}
