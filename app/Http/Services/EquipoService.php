<?php

namespace App\Http\Services;

use App\Models\Equipo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class EquipoService {

    private const POSITION_ORDER = ['Goalkeeper', 'Defender', 'Midfielder', 'Attacker'];

    public function getEquipos()
    {
        return Equipo::select('id', 'nombre', 'imagen', 'descripcion', 'has_white_flag', 'api_team_id')
            ->orderBy('nombre', 'asc')
            ->get();
    }

    public function getPlayersByPosition(Equipo $equipo): array
    {
        return Cache::remember("equipo:{$equipo->id}:players", now()->addHour(), function () use ($equipo) {
            $players = $equipo->players()
                ->where('is_active', true)
                ->orderByRaw('CAST(number AS UNSIGNED) ASC')
                ->orderBy('name', 'asc')
                ->get(['id', 'name', 'number', 'position', 'photo', 'age']);

            $grouped = [];
            foreach (self::POSITION_ORDER as $pos) {
                $grouped[] = [
                    'position'       => $pos,
                    'position_label' => trans('positions')[$pos] ?? $pos,
                    'players'        => $players
                        ->where('position', $pos)
                        ->values()
                        ->all(),
                ];
            }

            return $grouped;
        });
    }

}