<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRegistered extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Registrasi Berhasil')
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Akun Anda berhasil dibuat.')
            ->line('Terima kasih telah mendaftar!')
            ->action('Login Sekarang', url('/login'));
    }
}
