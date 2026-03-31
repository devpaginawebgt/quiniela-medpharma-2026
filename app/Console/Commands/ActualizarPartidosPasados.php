<?php

namespace App\Console\Commands;

use App\Http\Services\PartidoService;
use Illuminate\Console\Command;

class ActualizarPartidosPasados extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'partidos:actualizar-pasados';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza el estado de los partidos cuya hora ya pasó';

    public function __construct(
        private readonly PartidoService $partidoService
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->partidoService->actualizarPartidosPasados();

        $this->info('Estados de partidos actualizados correctamente.');
    }
}
