<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Sortable;
class SpecialistofAffairsandSports extends Model
{use Sortable;
    use HasFactory;
    protected $fillable = [
        'id',
        'activity_title',
        'description',
        'start_date',
        'end_date',
        'sports_teams',
        'sport_type',
        'baget',
        'activity_established_research_findings',

        'considerations',
        'content',

        'file',
    ];
}
