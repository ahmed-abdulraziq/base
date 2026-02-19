<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Authenticatable
{
    use Notifiable;
    protected $table = 'employees';

    public $timestamps = true;

    protected $fillable = [
        'doctor_id',
        'name',
        'phone',
        'email',
        'password',
        'job_title',
        'salary',
        'hire_date',
        'is_active',
        'approved_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'hire_date' => 'date',
        'is_active' => 'boolean',
        'salary' => 'decimal:2',
        'password' => 'hashed',
        'approved_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }

    /** الموظف المضاف من طبيب يحتاج موافقة الأدمن */
    public function isApproved(): bool
    {
        return $this->approved_at !== null;
    }

    public function scopeApproved($query)
    {
        return $query->whereNotNull('approved_at');
    }

    public function scopePendingApproval($query)
    {
        return $query->whereNotNull('doctor_id')->whereNull('approved_at');
    }

    /**
     * Get the appointments created by this employee.
     */
    public function createdAppointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'created_by', 'id');
    }

    /**
     * Scope to filter active employees only.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get full name.
     */
    public function getFullNameAttribute(): string
    {
        return $this->name ?? '';
    }
}
