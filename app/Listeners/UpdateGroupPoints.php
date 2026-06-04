<?php

namespace App\Listeners;

use App\Events\ResultCreated;
use App\Http\Services\PartidoService;

class UpdateGroupPoints
{
    public function __construct(
        private readonly PartidoService $partidoService
    ) {}

    public function handle(ResultCreated $event): void
    {
        $this->partidoService->actualizarPuntosEquipos();
    }
}
