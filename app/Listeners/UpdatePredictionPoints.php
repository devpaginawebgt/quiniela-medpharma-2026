<?php

namespace App\Listeners;

use App\Events\ResultCreated;
use App\Http\Services\PrediccionService;

class UpdatePredictionPoints
{
    public function __construct(
        private readonly PrediccionService $prediccionService
    ) {}

    public function handle(ResultCreated $event): void
    {
        $this->prediccionService->actualizarPuntosGlobalChunked();
    }
}
