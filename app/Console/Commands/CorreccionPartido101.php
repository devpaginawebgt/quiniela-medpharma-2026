<?php

namespace App\Console\Commands;

use App\Models\Partido;
use App\Models\Preccion;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CorreccionPartido101 extends Command
{
    protected $signature = 'app:correccion-partido-101 {--dry-run}';

    protected $description = 'Asigna los puntos de acerto_un_marcador a los usuarios del partido 101 (Francia 0 - 2 España) afectados por el bug de getResultadoPrediccion.';

    private const PARTIDO_ID = 101;

    public function handle()
    {
        // Comando deshabilitado: ya se ejecutó en producción el 2026-07-15.
        // Volver a correrlo duplicaría los puntos de los usuarios afectados.
        $this->error('Comando deshabilitado.');
        return Command::FAILURE;

        $partido = Partido::with(['puntos'])->find(self::PARTIDO_ID);

        if (!$partido) {
            $this->error('No se encontró el partido 101.');
            return Command::FAILURE;
        }

        $resultado = DB::table('resultado_partidos')
            ->where('partido_id', self::PARTIDO_ID)
            ->first();

        if (!$resultado) {
            $this->error('El partido 101 no tiene resultado registrado.');
            return Command::FAILURE;
        }

        $res1 = (int) $resultado->goles_equipo_1;
        $res2 = (int) $resultado->goles_equipo_2;

        if ($res1 !== 0 || $res2 !== 2) {
            $this->error("El resultado en la DB ({$res1}-{$res2}) no coincide con Francia 0 - 2 España. Se aborta por seguridad.");
            return Command::FAILURE;
        }

        $puntosASumar = $partido->puntos?->acerto_un_marcador ?? 1;

        $predicciones = Preccion::query()
            ->where('partido_id', self::PARTIDO_ID)
            ->whereRaw('NOT (goles_equipo_1 = ? AND goles_equipo_2 = ?)', [$res1, $res2])
            ->whereRaw('NOT (goles_equipo_1 < goles_equipo_2)')
            ->where(function ($q) use ($res1, $res2) {
                $q->where('goles_equipo_1', $res1)
                  ->orWhere('goles_equipo_2', $res2);
            })
            ->with('user:id,nombres,apellidos,puntos')
            ->get();

        if ($predicciones->isEmpty()) {
            $this->info('No hay usuarios afectados para el partido 101.');
            return Command::SUCCESS;
        }

        $this->info("Resultado del partido 101: Francia {$res1} - {$res2} España");
        $this->info("Puntos a sumar por usuario: {$puntosASumar}");
        $this->info("Usuarios afectados: {$predicciones->count()}");
        $this->newLine();

        $this->table(
            ['user_id', 'usuario', 'prediccion', 'puntos_actuales', 'puntos_nuevos'],
            $predicciones->map(fn ($p) => [
                $p->user_id,
                trim(($p->user?->nombres ?? '') . ' ' . ($p->user?->apellidos ?? '')),
                "{$p->goles_equipo_1}-{$p->goles_equipo_2}",
                $p->user?->puntos ?? 0,
                ($p->user?->puntos ?? 0) + $puntosASumar,
            ])->all()
        );

        if ($this->option('dry-run')) {
            $this->warn('Ejecución en modo --dry-run. No se aplicaron cambios.');
            return Command::SUCCESS;
        }

        if (!$this->confirm('¿Confirmas sumar los puntos a estos usuarios?', false)) {
            $this->warn('Operación cancelada.');
            return Command::SUCCESS;
        }

        DB::transaction(function () use ($predicciones, $puntosASumar) {
            $userIds = $predicciones->pluck('user_id')->unique()->all();

            User::whereIn('id', $userIds)->increment('puntos', $puntosASumar);
        });

        $this->info('Puntos asignados correctamente.');

        return Command::SUCCESS;
    }
}
