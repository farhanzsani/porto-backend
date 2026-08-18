<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'title',
        'description',
        'content',
        'featured_image',
        'client',
        'project_url',
        'github_url',
        'view_count',
    ];

    protected $casts = [];

    public function media(): HasMany
    {
        return $this->hasMany(ProjectMedia::class);
    }

    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class);
    }
}
