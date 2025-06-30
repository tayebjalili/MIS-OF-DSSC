<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Sortable;
class GeneralExecutiveManagement extends Model
{use Sortable;
    use HasFactory;

    protected $fillable = [
        'id',
        'job_objective',
        'description',
        'day_report',
        'report_file',
        'monthly_plan',
        'meeting_notes',
        'correspondence_log',
        'contact_info',
        'additional_tasks',
        'file',
    ];
}
