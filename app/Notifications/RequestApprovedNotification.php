<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class RequestApprovedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $title;
    protected $message;
    protected $url;
    protected $params;

    /**
     * Create a new notification instance.
     */
    public function __construct($title, $message, $url = '#', $params = [])
    {
        $this->title = $title;
        $this->message = $message;
        $this->url = $url;
        $this->params = $params;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'params' => $this->params,
            'url' => $this->url,
            'icon' => 'fas fa-check-circle',
            'color' => 'success',
        ];
    }
}
