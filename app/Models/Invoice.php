<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $table = 'invoices';

    protected $primaryKey = 'invoice_id';

    public $timestamps = true;

    protected $fillable = [
        'patient_id',
        'appointment_id',
        'invoice_date',
        'total_amount',
        'paid_amount',
        'payment_status',
        'payment_method',
        'notes',
    ];

    protected $casts = [
        'invoice_date' => 'datetime',
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the patient for the invoice.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'patient_id');
    }

    /**
     * Get the appointment for the invoice.
     */
    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class, 'appointment_id', 'appointment_id');
    }

    /**
     * Get the invoice details.
     */
    public function details(): HasMany
    {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id', 'invoice_id');
    }

    /**
     * Scope to get pending invoices (not fully paid).
     */
    public function scopePending($query)
    {
        return $query->where('payment_status', '!=', 'مدفوع بالكامل');
    }

    /**
     * Get remaining amount to pay.
     */
    public function getRemainingAmountAttribute(): float
    {
        return (float) ($this->total_amount - $this->paid_amount);
    }
}
