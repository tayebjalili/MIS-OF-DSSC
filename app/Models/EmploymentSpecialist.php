<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Sortable;
class EmploymentSpecialist extends Model
{use Sortable;
    use HasFactory;
    protected $fillable = [
        'name',
        'father_name',
        'id_canqor',
        'province',
        'university',
        'faculty',
        'department',
        'organization',
        'graduated_year',
        'percentage',
        'email',
        'phone_number',
        'file',



    ];
}
