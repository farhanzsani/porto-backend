<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $table = 'certificates';

    protected $fillable = [
        'title',
        'issuing_organization',
        'issue_date',
        'expiry_date',
        'credential_id',
        'credential_url',
        'image_path',
        'description',
        'is_active',
    ];

    protected $casts = [
        'issue_date'   => 'date',
        'expiry_date'  => 'date',
        'is_active'    => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getIsExpiredAttribute(): bool
    {
        return $this->expiry_date !== null && $this->expiry_date->isPast();
    }
}

