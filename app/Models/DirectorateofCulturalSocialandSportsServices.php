<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Sortable;
class DirectorateofCulturalSocialandSportsServices extends Model
{use Sortable;
    use HasFactory;
    protected $fillable = [
        'id',
        'job_title',
        'location',
        'reports_to',
        'essential_notes',
        'file',

    ];
}
