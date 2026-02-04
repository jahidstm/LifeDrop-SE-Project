<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_id',
        'hide_phone_number',
        'hide_location',
        'allow_anonymous_requests',
        'show_in_leaderboard',
        'updated_at',
    ];

    protected $casts = [
        'hide_phone_number' => 'boolean',
        'hide_location' => 'boolean',
        'allow_anonymous_requests' => 'boolean',
        'show_in_leaderboard' => 'boolean',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }
}
