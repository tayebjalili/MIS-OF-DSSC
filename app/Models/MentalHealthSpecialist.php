<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentalHealthSpecialist extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'job_title',
        'department',
        'location',
        'problem',
        'instructor',
        'duration',
        'result',
        'patient_intro',
        'education',
        'file',

    ];
}
