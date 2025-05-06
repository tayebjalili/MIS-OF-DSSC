<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectorateOfCoordinationAndStudentAffairs extends Model
{
    use HasFactory;
    protected $table = 'directorateof_coordination_and_student_affairs';

    protected $fillable = [
        'id',
        'job_title',
        'description',
        'file',

    ];
}
