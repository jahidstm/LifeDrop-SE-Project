<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodRequestResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'blood_request_id',
        'donor_id',
        'response_status',
        'responded_at',
        'claimed_at',
        'completed_at',
        'recipient_feedback',
        'donor_feedback',
        'recipient_rating',
        'donor_rating',
        'is_auto_approved',
        'auto_approved_at',
    ];

    protected $casts = [
        'responded_at' => 'datetime',
        'claimed_at' => 'datetime',
        'completed_at' => 'datetime',
        'is_auto_approved' => 'boolean',
        'auto_approved_at' => 'datetime',
    ];

    // Relationships
    public function bloodRequest()
    {
        return $this->belongsTo(BloodRequest::class);
    }

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    public function donation()
    {
        return $this->hasOne(Donation::class, 'blood_request_response_id');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('response_status', 'pending');
    }

    public function scopeAccepted($query)
    {
        return $query->where('response_status', 'accepted');
    }

    public function scopeCompleted($query)
    {
        return $query->where('response_status', 'completed');
    }

    public function scopeAutoApproved($query)
    {
        return $query->where('is_auto_approved', true);
    }
}
