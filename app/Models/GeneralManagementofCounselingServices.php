<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralManagementofCounselingServices extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'job_type',
        'description',
        'student_name',
        'faculty',
        'internship_company',
        'start_date',
        'end_date',
        'report_type',
        'content',
        'report_date',
        'file',
    ];
}
