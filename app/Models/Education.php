<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';

    protected $fillable = [
        'institution_name',
        'degree',
        'field_of_study',
        'description',
        'institution_logo',
        'institution_url',
        'location',
        'start_date',
        'end_date',
        'is_current',
        'grade',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
    ];

    public function scopeCurrent($query)
    {
        return $query->where('is_current', true);
    }
}
