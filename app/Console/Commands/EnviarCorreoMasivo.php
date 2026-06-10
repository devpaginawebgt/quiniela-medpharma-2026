<?php

namespace App\Console\Commands;

use App\Http\Services\BrevoMailerService;
use App\Mail\MassNotification;
use App\Models\Partido;
use App\Models\User;
use Illuminate\Console\Command;

class EnviarCorreoMasivo extends Command
{
    protected $signature = 'app:enviar-correo-masivo';

    protected $description = 'Envía un correo masivo a los usuarios filtrados vía Brevo (configuración dentro del comando)';

    public function handle(BrevoMailerService $brevo)
    {
        // ───────────────────────────────────────────────────────────
        // Configuración del envío — editar antes de cada corrida
        // ───────────────────────────────────────────────────────────

        $users = User::where('status_user', 1)
            ->whereNotNull('email')
            ->where('email', '!=', '')
            // ->whereIn('email', ['dev@paginawebguatemala.com', 'soporte@paginawebguatemala.com'])
            ->get();

        $partido = Partido::with([
            'equipos.equipoUno',
            'equipos.equipoDos',
        ])->find(1);

        // ───────────────────────────────────────────────────────────

        if (! $partido) {
            $this->error('No se encontró el Partido configurado para el correo.');
            return Command::FAILURE;
        }

        $total = $users->count();

        if ($total === 0) {
            $this->warn('No hay usuarios que coincidan con los filtros.');
            return Command::SUCCESS;
        }

        $this->info("Destinatarios encontrados: {$total}");

        if (! $this->confirm("¿Enviar correo a {$total} usuarios vía Brevo?", true)) {
            $this->info('Cancelado.');
            return Command::SUCCESS;
        }

        // Renderiza el Mailable una sola vez (mismo subject y HTML para todos).
        $mailable    = new MassNotification($partido);
        $subject     = $mailable->envelope()->subject;
        $htmlContent = $mailable->render();

        $sent   = 0;
        $failed = 0;

        $bar = $this->output->createProgressBar($total);
        $bar->start();

        foreach ($users->chunk(BrevoMailerService::MAX_BATCH) as $chunk) {
            $recipients = $chunk->map(function ($u) {
                $name = trim(($u->nombres ?? '').' '.($u->apellidos ?? ''));
                return [
                    'email' => $u->email,
                    'name'  => $name !== '' ? $name : null,
                ];
            })->values()->all();

            $count = count($recipients);

            try {
                $result = $brevo->sendBatch($recipients, $subject, $htmlContent);

                if ($result['success']) {
                    $sent += $count;
                } else {
                    $failed += $count;
                    $this->newLine();
                    $this->warn("Lote falló (HTTP {$result['status']}): ".json_encode($result['body']));
                }
            } catch (\Throwable $e) {
                $failed += $count;
                $this->newLine();
                $this->warn("Lote falló: {$e->getMessage()}");
            }

            $bar->advance($count);
        }

        $bar->finish();
        $this->newLine(2);

        $this->info("Enviados: {$sent}");
        if ($failed > 0) {
            $this->warn("Fallidos: {$failed}");
        }

        return Command::SUCCESS;
    }
}
