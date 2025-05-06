<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementofRelationswithSectoralAgencies extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'department_name',
        'sector_name',
        'title',
        'partner_institution',
        'description',
        'date_signed',
        'report_type',
        'content',
        'report_date',
        'file',
    ];
}
