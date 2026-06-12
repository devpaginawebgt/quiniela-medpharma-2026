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
            ->withExists('predictions')
            ->orderBy('puntos', 'desc')
            ->orderBy('created_at', 'asc')
            ->orderBy('id');
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
            ->orderBy('preccions.created_at', 'desc')
            ->orderBy('id');
    }
}
