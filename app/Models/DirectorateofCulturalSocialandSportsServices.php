<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectorateofCulturalSocialandSportsServices extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'job_title',
        'location',
        'reports_to',
        'position_code',
        'date_of_review',
        'qualifications',
        'skills',
        'additional_notes',
        'file',

    ];
}
