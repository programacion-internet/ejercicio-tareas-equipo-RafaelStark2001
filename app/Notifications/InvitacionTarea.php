<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Tarea;

class InvitacionTarea extends Notification
{
    use Queueable;

    public $tarea;

    /**
     * Create a new notification instance.
     */
    public function __construct(Tarea $tarea)
    {
        $this->tarea = $tarea;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    //public function via(object $notifiable): array
    //{
    //    return ['mail'];
    //}

    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    //public function toMail(object $notifiable): MailMessage
    //{
    //    return (new MailMessage)
    //        ->line('The introduction to the notification.')
    //        ->action('Notification Action', url('/'))
    //        ->line('Thank you for using our application!');
    //}

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Invitación a una tarea')
            ->greeting('¡Hola ' . $notifiable->name . '!')
            ->line('Has sido invitado a colaborar en la tarea: "' . $this->tarea->nombre . '"')
            ->action('Ver tarea', url('/tareas/' . $this->tarea->id))
            ->line('Gracias por usar nuestra aplicación.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
