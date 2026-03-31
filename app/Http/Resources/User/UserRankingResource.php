<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRankingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'nombres'   => $this->nombres,
            'apellidos' => $this->apellidos,
            'puntos'    => $this->puntos,
            'posicion'  => $this->posicion,
        ];
    }
}
