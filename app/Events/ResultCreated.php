<?php

namespace App\Events;

use App\Models\ResultadoPartido;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ResultCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public ResultadoPartido $result
    ) {}

    public function broadcastOn(): array
    {
        return [];
    }
}
