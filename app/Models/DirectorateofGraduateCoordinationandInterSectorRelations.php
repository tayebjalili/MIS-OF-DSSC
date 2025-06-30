<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Sortable;
class DirectorateofGraduateCoordinationandInterSectorRelations extends Model
{use Sortable;
    use HasFactory;

    protected $fillable = [
        'category',
        'title',
        'description',
        'file',
        'date',
        'report_frequency'
    ];

    protected $casts = [
        'date' => 'date'
    ];
}
