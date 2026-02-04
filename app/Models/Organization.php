<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'organization_name',
        'organization_type',
        'district',
        'upazila',
        'address',
        'license_number',
        'is_verified',
        'logo_url',
        'website_url',
        'verified_members_count',
        'description',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function members()
    {
        return $this->hasMany(OrganizationMember::class);
    }

    public function approvedMembers()
    {
        return $this->hasMany(OrganizationMember::class)
            ->where('membership_status', 'approved');
    }

    // Scopes
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('organization_type', $type);
    }

    public function scopeByDistrict($query, $district)
    {
        return $query->where('district', $district);
    }
}
