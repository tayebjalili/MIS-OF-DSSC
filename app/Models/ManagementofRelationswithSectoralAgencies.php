<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Sortable;
class ManagementofRelationswithSectoralAgencies extends Model
{use Sortable;
    use HasFactory;
    protected $fillable = [
        'id',

        'sector_name',
        'title',
        'partner_institution',
        'description',
        'date_signed',
        'report_type',

        'report_date',
        'file',
    ];
}
