<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Sortable;
class GeneralDatabaseManagement extends Model
{use Sortable;
    use HasFactory;

    protected $fillable = [
        'meeting_type',
        'meeting_number',
        'meeting_date',
        'description',
        'agenda_items',
        'file',
    ];

    protected $casts = [
        'agenda_items' => 'array',
        'meeting_date' => 'date',
    ];
}
