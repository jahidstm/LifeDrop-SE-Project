<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'donor_id',
        'membership_status',
        'approved_at',
        'approved_by',
        'rejection_reason',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    // Relationships
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    public function approvedByUser()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('membership_status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('membership_status', 'pending');
    }

    public function scopeRejected($query)
    {
        return $query->where('membership_status', 'rejected');
    }
}
