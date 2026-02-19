<?php

namespace App\Models;

use App\Enums\DayOfWeek;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoctorSchedule extends Model
{
    protected $table = 'doctor_schedule';

    public $timestamps = true;

    protected $fillable = [
        'doctor_id',
        'day_of_week',
        'start_time',
        'end_time',
        'is_available',
    ];

    protected $casts = [
        'day_of_week' => DayOfWeek::class,
        'is_available' => 'boolean',
    ];

    /**
     * Get the doctor for this schedule.
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }

    /**
     * Scope to filter available schedules only.
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }
}
