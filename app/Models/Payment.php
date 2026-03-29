<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $table = 'payments';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['enrollment_id', 'razorpay_order_id', 'razorpay_payment_id', 'razorpay_signature', 'amount', 'currency', 'status', 'method', 'bank', 'wallet', 'vpa', 'email', 'contact', 'description', 'error_code', 'error_reason', 'paid_at', 'transaction_type', 'type'];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'paid_at' => 'datetime',
        'amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the enrollment that owns the payment.
     */
    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    // ============ SCOPES ============

    /**
     * Scope to filter successful payments.
     */
    public function scopeSuccessful($query)
    {
        return $query->where('status', 'success');
    }

    /**
     * Scope to filter failed payments.
     */
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * Scope to filter pending payments.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to filter by payment type.
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope to filter by transaction method.
     */
    public function scopeByMethod($query, $method)
    {
        return $query->where('transaction_type', $method);
    }

    /**
     * Scope to get today's payments.
     */
    public function scopeToday($query)
    {
        return $query->whereDate('paid_at', today());
    }

    /**
     * Scope to get this month's payments.
     */
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('paid_at', now()->month)->whereYear('paid_at', now()->year);
    }

    /**
     * Scope to get this year's payments.
     */
    public function scopeThisYear($query)
    {
        return $query->whereYear('paid_at', now()->year);
    }

    /**
     * Scope to filter by enrollment.
     */
    public function scopeForEnrollment($query, $enrollmentId)
    {
        return $query->where('enrollment_id', $enrollmentId);
    }

    // ============ STATIC METHODS ============

    /**
     * Get the total successful amount.
     */
    public static function totalSuccessfulAmount()
    {
        return static::successful()->sum('amount');
    }

    /**
     * Get total amount for a specific type.
     */
    public static function totalByType($type)
    {
        return static::byType($type)->successful()->sum('amount');
    }

    /**
     * Get count of payments by status.
     */
    public static function countByStatus($status)
    {
        return static::where('status', $status)->count();
    }

    // ============ BOOLEAN CHECKS ============

    /**
     * Check if payment is successful.
     */
    public function isSuccessful(): bool
    {
        return $this->status === 'success';
    }

    /**
     * Check if payment is failed.
     */
    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    /**
     * Check if payment is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    // ============ LABEL & DISPLAY METHODS ============

    /**
     * Get transaction type label.
     */
    public function getTransactionTypeLabel(): string
    {
        $labels = [
            'upi' => 'UPI Transfer',
            'card' => 'Credit/Debit Card',
            'netbanking' => 'Net Banking',
            'wallet' => 'Digital Wallet',
        ];

        return $labels[$this->transaction_type] ?? ucfirst($this->transaction_type ?? 'Unknown');
    }

    /**
     * Get payment type label.
     */
    public function getPaymentTypeLabel(): string
    {
        $labels = [
            'course_enrollment' => 'Course Enrollment',
            'workshop_registration' => 'Workshop Registration',
            'event_registration' => 'Event Registration',
            'subscription' => 'Subscription',
            'other' => 'Other',
        ];

        return $labels[$this->type] ?? ucfirst(str_replace('_', ' ', $this->type ?? 'Unknown'));
    }

    /**
     * Get status badge class for Bootstrap.
     */
    public function getStatusBadgeClass(): string
    {
        return match ($this->status) {
            'success' => 'success',
            'failed' => 'danger',
            'pending' => 'warning',
            default => 'secondary',
        };
    }

    /**
     * Get formatted amount with currency.
     */
    public function getFormattedAmount(): string
    {
        return $this->currency . ' ' . number_format($this->amount, 2);
    }

    /**
     * Get payment method info (bank/wallet/vpa).
     */
    public function getPaymentMethodInfo(): ?string
    {
        return $this->bank ?? ($this->wallet ?? ($this->vpa ?? null));
    }

    /**
     * Get contact info (email or phone).
     */
    public function getContactInfo(): string
    {
        return $this->contact ?? ($this->email ?? 'N/A');
    }

    // ============ UTILITY METHODS ============

    /**
     * Check if payment is refundable (successful and recent).
     */
    public function isRefundable(): bool
    {
        // Refundable if success and within 90 days
        return $this->isSuccessful() && $this->paid_at && $this->paid_at->diffInDays(now()) <= 90;
    }

    /**
     * Get days since payment.
     */
    public function getDaysSincePayment(): ?int
    {
        return $this->paid_at ? $this->paid_at->diffInDays(now()) : null;
    }

    /**
     * Check if payment is recent (within 7 days).
     */
    public function isRecent(): bool
    {
        return $this->getDaysSincePayment() !== null && $this->getDaysSincePayment() <= 7;
    }

    /**
     * Get payment status text with icon.
     */
    public function getStatusWithIcon(): string
    {
        $icons = [
            'success' => '<i class="fas fa-check-circle text-success"></i>',
            'failed' => '<i class="fas fa-times-circle text-danger"></i>',
            'pending' => '<i class="fas fa-hourglass-half text-warning"></i>',
        ];

        $icon = $icons[$this->status] ?? '<i class="fas fa-question-circle text-secondary"></i>';
        return $icon . ' ' . ucfirst($this->status);
    }
}
