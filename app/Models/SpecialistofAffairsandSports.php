<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialistofAffairsandSports extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'activity_name',
        'description',
        'activity_date',
        'team_name',
        'sport_type',
        'coach_name',
        'report_type',
        'content',
        'report_date',
        'file',
    ];
}
