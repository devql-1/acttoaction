<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkshopRegistration extends Model
{
    protected $fillable = [
        'workshop_school_id',
        'age_group_id',
        'city_id',

        // Original columns in your table
        'participant_name',
        'participant_email',
        'participant_phone',
        'parent_name',
        'parent_phone',
        'tickets',
        'amount_per_ticket',
        'total_amount',
        'coupon_code',

        // New columns added via ALTER
        'email',
        'phone',
        'whatsapp',
        'student_name',
        'dob',
        'school_name',
        'workshop_name',
        'city_name',
        'age_group_name',
        'experience',
        'amount',
        'status',
        'razorpay_order_id',
        'razorpay_payment_id',
        'razorpay_signature',
        'message',
        'ip_address',
    ];

    protected $casts = [
        'dob' => 'date',
        'amount' => 'decimal:2',
    ];

    public function workshopSchool()
    {
        return $this->belongsTo(WorkshopSchool::class);
    }
    public function ageGroup()
    {
        return $this->belongsTo(WorkshopAgeGroup::class);
    }
    public function city()
    {
        return $this->belongsTo(WorkshopCity::class);
    }
    public function isConfirmed(): bool
    {
        return $this->status === 'confirmed';
    }
    public function isFree(): bool
    {
        return $this->amount == 0;
    }
}
