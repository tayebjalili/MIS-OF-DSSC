<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Sortable;
class SpecialistofCulturalServices extends Model
{use Sortable;
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'description',
        'start_date',
        'end_date',
        'report_type',
        'report_explination',
        'file',
    ];
}
