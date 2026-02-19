<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
    use Notifiable;
    protected $table = 'doctors';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'specialization_id',
        'license_number',
        'years_of_experience',
        'consultation_fee',
        'hire_date',
        'is_active',
        'approved_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'hire_date' => 'date',
            'is_active' => 'boolean',
            'consultation_fee' => 'decimal:2',
            'approved_at' => 'datetime',
            'password' => 'hashed',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function isApproved(): bool
    {
        return $this->approved_at !== null;
    }

    /**
     * Get the specialization of the doctor.
     */
    public function specialization(): BelongsTo
    {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }

    /**
     * Get the appointments for the doctor.
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'doctor_id', 'id');
    }

    /**
     * Get the medical examinations for the doctor.
     */
    public function medicalExaminations(): HasMany
    {
        return $this->hasMany(MedicalExamination::class, 'doctor_id', 'id');
    }

    /**
     * Get the prescriptions for the doctor.
     */
    public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescription::class, 'doctor_id', 'id');
    }

    /**
     * الموظفون الذين أضافهم الطبيب (بانتظار موافقة الأدمن أو معتمدون).
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'doctor_id', 'id');
    }

    /**
     * Get the doctor's schedule.
     */
    public function schedule(): HasMany
    {
        return $this->hasMany(DoctorSchedule::class, 'doctor_id', 'id');
    }

    /**
     * Scope to filter active doctors only.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get full name (للتوافق مع الكود الذي يستخدم full_name).
     */
    public function getFullNameAttribute(): string
    {
        return $this->name ?? '';
    }

    /**
     * للتوافق مع لوحة التحكم (عرض الدور).
     */
    public function getRoleAttribute(): string
    {
        return 'doctor';
    }
}
