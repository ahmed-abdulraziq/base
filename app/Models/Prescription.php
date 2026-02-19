<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prescription extends Model
{
    protected $table = 'prescriptions';

    public $timestamps = true;

    protected $fillable = [
        'examination_id',
        'patient_id',
        'doctor_id',
        'prescription_date',
        'notes',
    ];

    protected $casts = [
        'prescription_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the examination for the prescription.
     */
    public function examination(): BelongsTo
    {
        return $this->belongsTo(MedicalExamination::class, 'examination_id', 'id');
    }

    /**
     * Get the patient for the prescription.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    /**
     * Get the doctor for the prescription.
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }

    /**
     * Get the prescription details (medications).
     */
    public function details(): HasMany
    {
        return $this->hasMany(PrescriptionDetail::class, 'prescription_id', 'id');
    }
}
