<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'blood_group',
        'district',
        'upazila',
        'last_donation_date',
        'next_eligible_date',
        'availability_status',
        'is_verified',
        'hide_phone_number',
        'total_donations',
        'points',
        'current_badge',
        'last_login_at',
    ];

    protected $casts = [
        'last_donation_date' => 'date',
        'next_eligible_date' => 'date',
        'is_verified' => 'boolean',
        'hide_phone_number' => 'boolean',
        'last_login_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organizationMemberships()
    {
        return $this->hasMany(OrganizationMember::class);
    }

    public function bloodRequestResponses()
    {
        return $this->hasMany(BloodRequestResponse::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function donorPoints()
    {
        return $this->hasOne(DonorPoint::class);
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'donor_badges')->withTimestamps();
    }

    public function leaderboardEntries()
    {
        return $this->hasMany(Leaderboard::class);
    }

    public function nidVerification()
    {
        return $this->hasOne(NidVerification::class);
    }

    public function qrCard()
    {
        return $this->hasOne(QrCard::class);
    }

    public function privacySettings()
    {
        return $this->hasOne(PrivacySetting::class);
    }

    public function successStories()
    {
        return $this->hasMany(SuccessStory::class);
    }

    // Scopes
    public function scopeReady($query)
    {
        return $query->where('availability_status', 'ready');
    }

    public function scopeByBloodGroup($query, $bloodGroup)
    {
        return $query->where('blood_group', $bloodGroup);
    }

    public function scopeByDistrict($query, $district)
    {
        return $query->where('district', $district);
    }

    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    public function scopeTopDonors($query, $limit = 10)
    {
        return $query->orderBy('total_donations', 'desc')->limit($limit);
    }
}
