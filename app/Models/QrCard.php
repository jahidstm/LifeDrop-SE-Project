<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_id',
        'qr_code_string',
        'qr_image_url',
        'is_active',
        'expires_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'expires_at' => 'datetime',
    ];

    // Relationships
    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
