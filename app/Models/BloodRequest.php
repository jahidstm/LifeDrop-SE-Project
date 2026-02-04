<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_code',
        'patient_name',
        'required_blood_group',
        'quantity',
        'district',
        'upazila',
        'hospital_name',
        'phone_number',
        'urgency_level',
        'status',
        'latitude',
        'longitude',
        'notes',
        'expires_at',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'expires_at' => 'datetime',
    ];

    // Relationships
    public function responses()
    {
        return $this->hasMany(BloodRequestResponse::class);
    }

    public function acceptedResponses()
    {
        return $this->hasMany(BloodRequestResponse::class)
            ->where('response_status', 'accepted');
    }

    // Scopes
    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    public function scopeCritical($query)
    {
        return $query->where('urgency_level', 'critical');
    }

    public function scopeByBloodGroup($query, $bloodGroup)
    {
        return $query->where('required_blood_group', $bloodGroup);
    }

    public function scopeByDistrict($query, $district)
    {
        return $query->where('district', $district);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
