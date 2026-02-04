<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorPoint extends Model
{
    use HasFactory;

    protected $table = 'donor_points';

    protected $fillable = [
        'donor_id',
        'total_points',
        'current_level',
        'points_breakdown',
        'last_updated',
    ];

    protected $casts = [
        'points_breakdown' => 'json',
        'last_updated' => 'datetime',
    ];

    // Relationships
    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    // Scopes
    public function scopeTopPoints($query, $limit = 10)
    {
        return $query->orderBy('total_points', 'desc')->limit($limit);
    }

    public function scopeByLevel($query, $level)
    {
        return $query->where('current_level', $level);
    }
}
