<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentSpecialist extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'father_name',
        'orientation_notes',
        'contracts_signed_with',
        'students_referred_for_jobs',
        'training_sessions',
        'partner_organizations',
        'monthly_report',
        'phone_number',
        'file',

    ];
}
