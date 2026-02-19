<?php

namespace App\Notifications;

use App\Models\ContactMessage;
use Illuminate\Notifications\Messages\MailMessage;

class ContactNotification extends BaseNotification
{
    public $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(ContactMessage $message)
    {
        $this->message = $message;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('translate.new_contact_message') . ': ' . $this->message->subject)
            ->greeting(__('translate.hello') . ' ' . $notifiable->name)
            ->line(__('translate.new_contact_message_received'))
            ->line(__('translate.from') . ': ' . $this->message->name . ' (' . $this->message->email . ')')
            ->line(__('translate.subject') . ': ' . $this->message->subject)
            ->line(__('translate.message') . ': ' . $this->message->message)
            ->action(__('translate.view_message'), route('dashboard.contact_messages.show', $this->message->id))
            ->line(__('translate.thank_you'));
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'id' => $this->message->id,
            'title' => 'translate.new_contact_message',
            'message' => 'translate.new_contact_message_from',
            'params' => [
                'name' => $this->message->name,
                'subject' => $this->message->subject,
            ],
            'url' => route('dashboard.contact_messages.show', $this->message->id),
            'type' => 'contact_message',
        ];
    }
}
