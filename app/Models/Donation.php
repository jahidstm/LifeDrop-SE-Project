<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_id',
        'blood_request_response_id',
        'donation_date',
        'next_eligible_date',
        'status',
        'points_earned',
        'auto_cooldown_until',
        'confirmed_by',
        'confirmation_date',
        'notes',
    ];

    protected $casts = [
        'donation_date' => 'date',
        'next_eligible_date' => 'date',
        'auto_cooldown_until' => 'date',
        'confirmation_date' => 'datetime',
    ];

    // Relationships
    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    public function bloodRequestResponse()
    {
        return $this->belongsTo(BloodRequestResponse::class);
    }

    public function confirmedByUser()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    // Scopes
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending_confirmation');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('donation_date', 'desc');
    }
}
