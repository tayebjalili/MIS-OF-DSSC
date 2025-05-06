<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialistofCoordinationandUniversityRelations extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'activity_name',
        'activity_date',
        'report_type',
        'description',
        'department',
        'file',
    ];
}
