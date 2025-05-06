<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialistofPracticalWorkinSocialSciencesandLaw extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'faculty',
        'date',
        'report_type',
        'description',
        'file',

    ];
}
