<?php

namespace App\Models;

use App\Enums\Gender;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\HasAttachments;

class Patient extends Authenticatable
{
    use Notifiable, HasAttachments;
    protected $table = 'patients';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'date_of_birth',
        'gender',
        'phone',
        'email',
        'password',
        'address',
        'blood_type',
        'allergies',
        'medical_history',
        'emergency_contact_name',
        'emergency_contact_phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'gender' => Gender::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the appointments for the patient.
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'patient_id', 'id');
    }

    /**
     * Get the medical examinations for the patient.
     */
    public function medicalExaminations(): HasMany
    {
        return $this->hasMany(MedicalExamination::class, 'patient_id', 'id');
    }

    /**
     * Get the prescriptions for the patient.
     */
    public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescription::class, 'patient_id', 'id');
    }

    /**
     * Get the invoices for the patient.
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'patient_id', 'id');
    }

    /**
     * Get full name.
     */
    public function getFullNameAttribute(): string
    {
        return $this->name ?? '';
    }
}
