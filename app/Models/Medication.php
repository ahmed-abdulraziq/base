<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medication extends Model
{
    protected $table = 'medications';

    public $timestamps = true;

    protected $fillable = [
        'medication_name',
        'generic_name',
        'manufacturer',
        'type',
        'unit',
        'price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the prescription details for this medication.
     */
    public function prescriptionDetails(): HasMany
    {
        return $this->hasMany(PrescriptionDetail::class, 'medication_id', 'medication_id');
    }
}
