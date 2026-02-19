<?php

namespace App\Notifications;

use App\Models\Doctor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewDoctorRegisteredNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $doctor;

    /**
     * Create a new notification instance.
     */
    public function __construct(Doctor $doctor)
    {
        $this->doctor = $doctor;
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
            'title' => 'translate.new_doctor_registered',
            'message' => 'translate.doctor_registered_message',
            'params' => [
                'name' => $this->doctor->full_name,
            ],
            'url' => route('dashboard.clinic.doctors.index', ['filter_search' => $this->doctor->email]),
            'icon' => 'fas fa-user-md',
            'color' => 'info',
        ];
    }
}
