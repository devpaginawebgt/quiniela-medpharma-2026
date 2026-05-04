<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;

class ResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public string $token) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $url = route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);

        $expireMinutes = Config::get('auth.passwords.users.expire', 60);

        return (new MailMessage)
            ->subject('Restablece tu contraseña - ' . config('app.name'))
            ->view('emails.reset-password', [
                'user' => $notifiable,
                'url' => $url,
                'expireMinutes' => $expireMinutes,
            ]);
    }
}
