<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL; // Import the URL facade

class VerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;

    protected $type; // Add a type property

    public function __construct($type)
    {
        $this->type = $type; // Set the type
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Verifikasi Email')
            ->line('Silakan klik tombol di bawah ini untuk memverifikasi email Anda.')
            ->action('Verifikasi Email', $this->verificationUrl($notifiable))
            ->line('Terima kasih telah bergabung dengan kami!');
    }

    protected function verificationUrl($notifiable)
   {
       return URL::temporarySignedRoute(
           'verification.verify',
           now()->addMinutes(60),
           [
               'id' => $notifiable->getKey(),
               'type' => $this->type // Ensure you are passing the type
           ]
       );
   }
    

    public function toArray($notifiable)
    {
        return [];
    }
}
