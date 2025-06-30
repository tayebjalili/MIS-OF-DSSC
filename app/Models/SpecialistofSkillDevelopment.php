<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Sortable;
class SpecialistofSkillDevelopment extends Model
{
    use Sortable;
    use HasFactory;

    protected $fillable = [
        'student_name',
        'father_name',
        'university',
        'faculty',
        'national_id',
        'invention_type',
        'invention_place',
        'expense',
        'completion_status',
        'incompletion_reason',
        'file',
    ];
}
