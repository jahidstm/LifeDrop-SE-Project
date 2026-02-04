<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'action_type',
        'description',
        'table_name',
        'record_id',
        'old_value',
        'new_value',
        'ip_address',
    ];

    protected $casts = [
        'old_value' => 'json',
        'new_value' => 'json',
    ];

    // Relationships
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Scopes
    public function scopeByAction($query, $action)
    {
        return $query->where('action_type', $action);
    }

    public function scopeByTable($query, $table)
    {
        return $query->where('table_name', $table);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
