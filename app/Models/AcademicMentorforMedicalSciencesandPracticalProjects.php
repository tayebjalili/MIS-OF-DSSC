<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicMentorforMedicalSciencesandPracticalProjects extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'objective',
        'specialized_duties',
        'managerial_duties',
        'coordination_duties',
        'summary',
        'file',

    ];
}
