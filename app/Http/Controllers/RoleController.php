<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleModel;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function list()

    {
        // $PermissionRole = PermissionRoleModel::getPermission('Role', Auth::user()->role_id);
        // if (empty($PermissionRole)) {
        //     abort(404);
        // }


        // $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add Role', Auth::user()->role_id);
        // $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit Role', Auth::user()->role_id);
        // $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete Role', Auth::user()->role_id);



        $data['getRecord'] = RoleModel::getRecord();

        return view('panel.roles.list', $data);
    }

    public function add()
    {
        // $PermissionRole = PermissionRoleModel::getPermission('Add Role', Auth::user()->role_id);

        // if (empty($PermissionRole)) {
        //     abort(404);
        // }
        $getPermissionModel = PermissionModel::getRecord();
        $data['getPermission'] = $getPermissionModel; // Corrected line
        return view('panel.roles.add', $data);
    }

    public function insert(Request $request)
    {
        // $PermissionRole = PermissionRoleModel::getPermission('Add Role', Auth::user()->role_id);
        // if (empty($PermissionRole)) {
        //     abort(404);
        // }


        // $validPermissions = PermissionModel::whereIn('id', $request->permission_id)->pluck('id')->toArray();
        // if (count($validPermissions) !== count($request->permission_id)) {
        //     return redirect()->back()->withErrors('Some selected permissions are invalid.');
        // }




        $save = new RoleModel;
        $save->name = $request->name;
        $save->save();

        PermissionRoleModel::InserUpdateRecord($request->permission_id, $save->id); //i fix the code like the video like change InsertUpdateRecord to InserUpdateRecord to it

        return redirect('panel/roles')->with('success', 'Role sucessfully created');
    }

    public function edit($id)
    {
        // $PermissionRole = PermissionRoleModel::getPermission(' Edit Role', Auth::user()->role_id);
        // if (empty($PermissionRole)) {
        //     abort(404);
        // }
        $data['getRecord'] = RoleModel::getSingle($id);
        $data['getPermission'] = PermissionModel::getRecord();
        $data['getRolePermission'] = PermissionRoleModel::getRolePermission($id);

        return view('panel.roles.edit', $data);
    }
    public function update($id, Request $request)
    {

        // $PermissionRole = PermissionRoleModel::getPermission('Edit Role', Auth::user()->role_id);
        // if (empty($PermissionRole)) {
        //     abort(404);
        // }
        $save = RoleModel::getSingle($id);
        $save->name = $request->name;
        $save->save();

        PermissionRoleModel::InserUpdateRecord($request->permission_id, $save->id);



        return redirect('panel/roles/')->with('success', 'Role sucessfully updated');
    }


    public function delete($id)
    {

        // $PermissionRole = PermissionRoleModel::getPermission(' Delete Role', Auth::user()->role_id);
        // if (!empty($PermissionRole)) {
        //     abort(404);
        // }
        $save = RoleModel::getSingle($id);
        $save->delete();
        return redirect('panel/roles')->with('success', 'Role sucessfully deleted');
    }
}
