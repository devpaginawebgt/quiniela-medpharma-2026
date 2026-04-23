<?php

namespace App\Http\Resources\Equipo;

use App\Http\Services\HelperService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EquipoGrupoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->nombre,
            'image' => HelperService::ImagePath($this->imagen),
            'pj' => $this->partidos_jugados,
            'pg' => $this->partidos_ganados,
            'pe' => $this->partidos_empatados,
            'pp' => $this->partidos_perdidos,
            'gf' => $this->goles_favor,
            'gc' => $this->goles_contra,
            'dg' => $this->goles_favor - $this->goles_contra,
            'pts' => $this->puntos,
            'hasWhiteFlag' => $this->has_white_flag,
        ];
    }
}
