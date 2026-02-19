<?php

namespace App\Models;

use App\Enums\InvoicePaymentMethod;
use App\Enums\InvoicePaymentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $table = 'invoices';

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
        'payment_status' => InvoicePaymentStatus::class,
        'payment_method' => InvoicePaymentMethod::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the patient for the invoice.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    /**
     * Get the appointment for the invoice.
     */
    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class, 'appointment_id', 'id');
    }

    /**
     * Get the invoice details.
     */
    public function details(): HasMany
    {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id', 'id');
    }

    /**
     * Scope to get pending invoices (not fully paid).
     */
    public function scopePending($query)
    {
        return $query->where('payment_status', '!=', \App\Enums\InvoicePaymentStatus::Paid->value);
    }

    /**
     * Get remaining amount to pay.
     */
    public function getRemainingAmountAttribute(): float
    {
        return (float) ($this->total_amount - $this->paid_amount);
    }
}
