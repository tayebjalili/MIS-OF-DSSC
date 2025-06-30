<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Sortable;
class SpecialistofPracticalWorkinSocialSciencesandLaw extends Model
{use Sortable;
    use HasFactory;
    protected $fillable = [
        'id',
        'job_type',
        'description',
        'student_name',
        'father_name',
        'faculty',
        'university_name',
        'internship_company',
        'start_date',
        'end_date',
        'job_time',
        'report_type',
        'content',
        'report_date',
        'file',

    ];
}
