<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermissionRoleModel extends Model
{
    use HasFactory;
    protected $table = 'permission_role';

    static public function InserUpdateRecord($permission_ids, $role_id) // i here alse change the InsertUpdateRecord to the InserUpdateRecord like the video 
    {
        // Ensure that all permission_ids are valid
        $validPermissions = PermissionModel::whereIn('id', $permission_ids)->pluck('id')->toArray();
        if (count($validPermissions) !== count($permission_ids)) {
            throw new \Exception('Some permissions are invalid.');
        }
        PermissionRoleModel::where('role_id', '=', $role_id)->delete();
        foreach ($permission_ids as $permission_id) {
            $save = new PermissionRoleModel;
            $save->permission_id = $permission_id;
            $save->role_id = $role_id;
            $save->save();
        }
    }

    static public function getRolePermission($role_id)
    {
        return PermissionRoleModel::where('role_id', '=', $role_id)->get();
    }

    static public function getPermission($slug, $role_id)
    {
        return PermissionRoleModel::select('permission_role.id')
            ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
            ->where('permission_role.role_id', '=', $role_id)

            ->count();
    }
}
