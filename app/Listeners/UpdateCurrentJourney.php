<?php

namespace App\Listeners;

use App\Events\JourneyCompleted;
use App\Http\Services\PartidoService;

class UpdateCurrentJourney
{
    public function __construct(
        private readonly PartidoService $partidoService
    ) {}

    public function handle(JourneyCompleted $event): void
    {
        $this->partidoService->updateCurrentJourney($event->journey);
    }
}
