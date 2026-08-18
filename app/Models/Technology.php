<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Technology extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'description',
        'icon',
        'color',
        'proficiency_level',
        'years_experience',
        'is_featured',
    ];

    protected $casts = [
        'proficiency_level' => 'integer',
        'years_experience' => 'decimal:1',
        'is_featured' => 'boolean',
    ];

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
