<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

class OrderStatusUpdatedNotification extends BaseNotification
{
    /**
     * Create a new notification instance.
     */
    public function __construct(
        public int $orderId,
        public string $oldStatus,
        public string $newStatus,
        public ?string $orderNumber = null
    ) {
        //
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        $orderNumber = $this->orderNumber ?? '#' . $this->orderId;

        return (new MailMessage)
            ->subject('Order Status Updated - ' . $orderNumber)
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your order status has been updated.')
            ->line('Order Number: ' . $orderNumber)
            ->line('Previous Status: ' . ucfirst($this->oldStatus))
            ->line('Current Status: ' . ucfirst($this->newStatus))
            ->action('View Order', url('/orders/' . $this->orderId))
            ->line('Thank you for your business!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array<string, mixed>
     */
    public function toArray($notifiable): array
    {
        return [
            'type' => 'order_status_updated',
            'title' => 'translate.order_status_updated',
            'message' => 'translate.order_status_updated_message',
            'params' => [
                'old_status' => ucfirst($this->oldStatus),
                'new_status' => ucfirst($this->newStatus),
            ],
            'order_id' => $this->orderId,
            'order_number' => $this->orderNumber ?? '#' . $this->orderId,
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
        ];
    }
}

