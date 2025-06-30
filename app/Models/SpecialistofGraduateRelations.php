<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Sortable;
class SpecialistofGraduateRelations extends Model
{use Sortable;
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'father_name',
        'university',
        'faculty',
        'department',
        'id_conqor',
        'percentage',
        'start_year',
        'graduated_year',
        'observations',
        'phone_number',
        'email',
        'file',

    ];
}
