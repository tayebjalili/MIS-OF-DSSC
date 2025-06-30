<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Sortable;

class DirectorateOfCoordinationAndStudentAffairs extends Model
{
    use Sortable;
    use HasFactory;
    protected $table = 'directorateof_coordination_and_student_affairs';

    protected $fillable = [
        'academic_institution_name',
        'relevant_management_in_universities',
        'creative_students_intro',
        'cV_writing',
        'new_students_orientation',

        'honor_students_encouragement',


        'short_term_courses_credits',
        'disabled_students',

        'file',

    ];
}
