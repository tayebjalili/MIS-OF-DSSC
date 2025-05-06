<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialistofGraduateRelations extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'father_name',
        'university',
        'faculty',
        'department',
        'grades',
        'percentage',
        'year',
        'final_percentage',
        'phone_number',
        'photo',
        'looks',
        'file',
    ];
}
