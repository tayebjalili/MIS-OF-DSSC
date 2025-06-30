<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Sortable;
class RoleModel extends Model
{use Sortable;
    use HasFactory;
    // Explicitly set the table name
    protected $table = 'roles';
    protected $fillable = [
        'id',
        'name',
    ];
    static public function getRecord()
    {
        return RoleModel::get();
    }

    static public function getSingle($id)
    {
        return RoleModel::find($id);
    }
}
