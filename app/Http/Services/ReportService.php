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

    public function getPronosticos(string|int $jornada_id)
    {
        return Preccion::with([
                'user.country',
                'partido.jornada',
                'partido.puntos',
                'partido.equipos.equipoUno',
                'partido.equipos.equipoDos',
                'resultado',
            ])
            ->when(!empty($jornada_id), function($query) use($jornada_id) {
                $query->whereHas('partido', function($query) use($jornada_id) {
                    $query->where('jornada_id', $jornada_id);
                });
            })
            ->select('preccions.*')
            ->orderBy('preccions.created_at', 'desc')
            ->orderBy('id');
    }
}
