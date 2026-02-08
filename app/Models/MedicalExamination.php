<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MedicalExamination extends Model
{
    protected $table = 'medical_examinations';

    protected $primaryKey = 'examination_id';

    public $timestamps = true;

    protected $fillable = [
        'appointment_id',
        'patient_id',
        'doctor_id',
        'examination_date',
        'symptoms',
        'diagnosis',
        'notes',
    ];

    protected $casts = [
        'examination_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the appointment for the examination.
     */
    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class, 'appointment_id', 'appointment_id');
    }

    /**
     * Get the patient for the examination.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'patient_id');
    }

    /**
     * Get the doctor for the examination.
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'doctor_id');
    }

    /**
     * Get the prescription for the examination.
     */
    public function prescription(): HasOne
    {
        return $this->hasOne(Prescription::class, 'examination_id', 'examination_id');
    }
}
