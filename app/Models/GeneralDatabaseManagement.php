<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralDatabaseManagement extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'student_name',
        'student_type',
        'skills',
        'student_info',
        'file',
    ];
}
