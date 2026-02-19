<?php

namespace App\Notifications;

use App\Models\Employee;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewEmployeeAddedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $employee;

    /**
     * Create a new notification instance.
     */
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
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
            'title' => 'translate.new_employee_added',
            'message' => 'translate.employee_added_message',
            'params' => [
                'employee_name' => $this->employee->full_name,
                'doctor_name' => $this->employee->doctor->full_name,
                'name' => $this->employee->full_name // Fallback/Alternative depending on usage
            ],
            'url' => $notifiable instanceof \App\Models\Doctor 
                ? route('doctor.employees.index', ['filter_search' => $this->employee->email]) 
                : route('dashboard.clinic.employees.index', ['filter_search' => $this->employee->email]),
            'icon' => 'fas fa-user-nurse',
            'color' => 'warning',
        ];
    }
}
