<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialistofCulturalServices extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'description',
        'event_date',
        'report_type',
        'file',
    ];
}
