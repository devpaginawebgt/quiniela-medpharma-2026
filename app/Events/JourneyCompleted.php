<?php

namespace App\Events;

use App\Models\Jornada;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JourneyCompleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Jornada $journey
    ) {}

    public function broadcastOn(): array
    {
        return [];
    }
}
