<?php

namespace App\Mail;

use App\Models\Partido;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MassNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Partido $partido) {}

    public function envelope(): Envelope
    {
        $e1 = $this->partido->equipos->equipoUno->nombre ?? 'Equipo 1';
        $e2 = $this->partido->equipos->equipoDos->nombre ?? 'Equipo 2';

        return new Envelope(
            subject: "¡{$e1} vs {$e2} comienza pronto!",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.mass-notification',
            with: [
                'partido' => $this->partido,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
