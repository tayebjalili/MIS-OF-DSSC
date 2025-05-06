<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialistofSkillDevelopment extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'type',
        'description',
        'day_report',
        'weakly_report',
        'monthly_report',
        'year_report',
        'file',
    ];
}
