<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Sortable;

class PermissionModel extends Model
{use Sortable;
    use HasFactory;

    protected $table = 'permissions';


    static public function getSingle($id)
    {
        return RoleModel::find($id);
    }

    static public function getRecord()
    {
        $getPermission = PermissionModel::groupBy('groupby')->get();
        $result = array();

        foreach ($getPermission as $value) {
            $getPermissionGroup = PermissionModel::getPermissionGroup($value->groupby);
            $data = array();
            $data['id'] = $value->id;
            $data['name'] = $value->name;

            foreach ($getPermissionGroup as $valueG) {
                $dataG = array();
                $dataG['id'] = $valueG->id;
                $dataG['name'] = $valueG->name;
                $group[] = $dataG;
            }
            $data['group'] = $group;
            $result[] = $data;
        }
        return $result;
    }
    static public function getPermissionGroup($groupby)
    {
        return PermissionModel::where('groupby', '=', $groupby)->get();
    }
}
