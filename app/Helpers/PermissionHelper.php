<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;
use App\Models\PermissionModel;

class PermissionHelper
{
    public static function check($slug)
    {
        $user = Auth::user();
        if (!$user || !$user->role_id) {
            return false;
        }

        $permission = PermissionModel::where('name', $slug)->first();
        if (!$permission) {
            return false;
        }
        return PermissionRoleModel::where('role_id', $user->role_id)
            ->where('permission_id', $permission->id)
            ->exists();
    }
}
