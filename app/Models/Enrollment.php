<?php
namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = ['first_name', 'last_name', 'dob', 'age', 'gender', 'father_name', 'mother_name', 'parent_phone', 'parent_email', 'phone', 'email', 'address', 'school', 'grade', 'achievements', 'state', 'city', 'centre', 'mode', 'course', 'reference_id', 'terms_accepted', 'newsletter_subscribed', 'status', 'fee'];

    protected $casts = [
        'dob' => 'date',
        'terms_accepted' => 'boolean',
        'newsletter_subscribed' => 'boolean',
    ];

    /**
     * Auto-generate a unique reference ID before creating.
     */
    protected static function booted()
    {
        static::creating(function ($enrollment) {
            do {
                $ref = 'ATA-' . strtoupper(Str::random(6));
            } while (self::where('reference_id', $ref)->exists());

            $enrollment->reference_id = $ref;
        });
    }
    // In app/Models/Enrollment.php
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function latestPayment()
    {
        return $this->hasOne(Payment::class)->latestOfMany();
    }
}
