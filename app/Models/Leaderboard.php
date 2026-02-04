<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_id',
        'rank',
        'donation_count',
        'total_points',
        'district',
        'region_type',
        'last_updated',
    ];

    protected $casts = [
        'last_updated' => 'datetime',
    ];

    // Relationships
    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    // Scopes
    public function scopeNational($query)
    {
        return $query->where('region_type', 'national');
    }

    public function scopeDistrict($query)
    {
        return $query->where('region_type', 'district');
    }

    public function scopeTopRanks($query, $limit = 10)
    {
        return $query->orderBy('rank')->limit($limit);
    }

    public function scopeByDistrict($query, $district)
    {
        return $query->where('district', $district);
    }
}
