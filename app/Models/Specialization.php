<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specialization extends Model
{
    protected $table = 'specializations';

    public $timestamps = true;

    protected $fillable = [
        'specialization_name',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the doctors for this specialization.
     */
    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class, 'specialization_id', 'specialization_id');
    }
}
