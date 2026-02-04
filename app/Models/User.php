<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relationships
    public function donor()
    {
        return $this->hasOne(Donor::class);
    }

    public function organization()
    {
        return $this->hasOne(Organization::class);
    }

    public function adminActivities()
    {
        return $this->hasMany(AdminActivity::class, 'admin_id');
    }

    public function approvedOrganizationMembers()
    {
        return $this->hasMany(OrganizationMember::class, 'approved_by');
    }

    public function verifiedNidRecords()
    {
        return $this->hasMany(NidVerification::class, 'verified_by');
    }

    public function reportResolvedBy()
    {
        return $this->hasMany(Report::class, 'resolved_by');
    }

    public function confirmedDonations()
    {
        return $this->hasMany(Donation::class, 'confirmed_by');
    }

    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class, 'author_id');
    }

    // Scopes
    public function scopeDonors($query)
    {
        return $query->where('role', 'donor');
    }

    public function scopeOrganizations($query)
    {
        return $query->where('role', 'organization');
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
