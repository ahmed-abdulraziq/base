<?php

namespace App\Jobs;

use Illuminate\Contracts\Notifications\Dispatcher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendNotificationJob extends BaseJob
{
    /**
     * Create a new job instance.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     */
    public function __construct(
        public Model $notifiable,
        public Notification $notification
    ) {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Dispatcher $dispatcher): void
    {
        try {
            $dispatcher->send($this->notifiable, $this->notification);

            Log::info('Notification sent successfully', [
                'notifiable_type' => get_class($this->notifiable),
                'notifiable_id' => $this->notifiable->id,
                'notification_type' => get_class($this->notification),
            ]);
        } catch (Throwable $e) {
            Log::error('Failed to send notification', [
                'notifiable_type' => get_class($this->notifiable),
                'notifiable_id' => $this->notifiable->id,
                'notification_type' => get_class($this->notification),
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    /**
     * Handle a job failure.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(?Throwable $exception): void
    {
        parent::failed($exception);

        Log::error('SendNotificationJob failed after all retries', [
            'notifiable_type' => get_class($this->notifiable),
            'notifiable_id' => $this->notifiable->id,
            'notification_type' => get_class($this->notification),
            'exception' => $exception?->getMessage(),
        ]);
    }
}



