<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectorateofGraduateCoordinationandInterSectorRelations extends Model
{
    use HasFactory;

    protected $fillable = [
        'responsibility_type',
        'title',
        'description',
        'report_frequency',
        'report_file',
        'file',
    ];
}
