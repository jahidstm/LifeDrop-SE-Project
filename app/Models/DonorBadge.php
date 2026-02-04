<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorBadge extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_id',
        'badge_id',
        'unlocked_at',
    ];

    protected $casts = [
        'unlocked_at' => 'datetime',
    ];

    // Relationships
    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    public function badge()
    {
        return $this->belongsTo(Badge::class);
    }
}
