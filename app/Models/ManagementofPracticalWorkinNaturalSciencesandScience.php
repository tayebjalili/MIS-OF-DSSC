<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementofPracticalWorkinNaturalSciencesandScience extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'full_name',
        'father_name',
        'field_of_study',
        'university',
        'internship_organization',
        'internship_duration',
        'internship_type',
        'research_topic',
        'graduation_year',
        'file',

    ];
}
