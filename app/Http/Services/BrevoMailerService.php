<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class BrevoMailerService
{
    public const MAX_BATCH = 1000;

    private string $apiKey;
    private string $endpoint;
    private string $fromEmail;
    private string $fromName;

    public function __construct()
    {
        $this->apiKey    = (string) config('services.brevo.key');
        $this->endpoint  = rtrim((string) config('services.brevo.endpoint'), '/');
        $this->fromEmail = (string) config('services.brevo.from_email');
        $this->fromName  = (string) config('services.brevo.from_name');

        if ($this->apiKey === '' || $this->fromEmail === '') {
            throw new RuntimeException('Brevo no está configurado. Define BREVO_API_KEY y BREVO_FROM_EMAIL en el .env.');
        }
    }

    /**
     * Envía el mismo correo a múltiples destinatarios en una sola petición HTTP.
     *
     * @param  array<int, array{email: string, name?: ?string}>  $recipients
     * @return array{success: bool, status: int, body: mixed}
     */
    public function sendBatch(array $recipients, string $subject, string $htmlContent): array
    {
        if (empty($recipients)) {
            throw new RuntimeException('No hay destinatarios en el lote.');
        }

        if (count($recipients) > self::MAX_BATCH) {
            throw new RuntimeException('El lote excede el máximo de '.self::MAX_BATCH.' destinatarios por petición.');
        }

        $messageVersions = array_map(static function (array $r) {
            $to = ['email' => $r['email']];
            if (! empty($r['name'])) {
                $to['name'] = $r['name'];
            }
            return ['to' => [$to]];
        }, $recipients);

        $payload = [
            'sender' => [
                'email' => $this->fromEmail,
                'name'  => $this->fromName,
            ],
            // Brevo exige un "to" en el root aunque se use messageVersions; usamos el primero.
            'to'              => [['email' => $recipients[0]['email']]],
            'subject'         => $subject,
            'htmlContent'     => $htmlContent,
            'messageVersions' => $messageVersions,
        ];

        $response = Http::withHeaders([
            'accept'       => 'application/json',
            'api-key'      => $this->apiKey,
            'content-type' => 'application/json',
        ])->timeout(60)->post($this->endpoint.'/smtp/email', $payload);

        return [
            'success' => $response->successful(),
            'status'  => $response->status(),
            'body'    => $response->json() ?? $response->body(),
        ];
    }
}
