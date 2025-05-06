<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleModel;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function list()
    {
        /* $PermissionRole = PermissionRoleModel::getPermission('User', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }


        $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add User', Auth::user()->role_id);
        $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit User', Auth::user()->role_id);
        $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete User', Auth::user()->role_id);*/



        $data['getRecord'] = User::getRecord();
        return view('panel.user.list', $data);
    }

    public function add()
    {
        /* $PermissionRole = PermissionRoleModel::getPermission('Add User', Auth::user()->role_id);

        if (empty($PermissionRole)) {
            abort(404);
        }*/
        $data['getRole'] = RoleModel::getRecord();

        return view('panel.user.add', $data);
    }

    public function edit($id)
    {
        /* $PermissionRole = PermissionRoleModel::getPermission('Edit User', Auth::user()->role_id);

        if (empty($PermissionRole)) {
            abort(404);
        }*/

        $data['getRecord'] = User::getSingel($id);
        $data['getRole'] = RoleModel::getRecord();
        return view('panel.user.edit', $data);
    }
    public function insert(Request $request)
    {
        /* $PermissionRole = PermissionRoleModel::getPermission('Add User', Auth::user()->role_id);

        if (empty($PermissionRole)) {
            abort(404);
        }*/
        request()->validate([
            'email' => 'required|email|unique:users',
        ]);

        $user = new user;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->role_id = trim($request->role_id);
        $user->save();

        return redirect('panel/user')->with('sucess', 'User is successfully created');
    }
    public function update($id, Request $request)
    {
        /*$PermissionRole = PermissionRoleModel::getPermission('Edit User', Auth::user()->role_id);

        if (empty($PermissionRole)) {
            abort(404);
        }*/
        $user = User::getSingle($id);
        $user->name = trim($request->name);
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->role_id = trim($request->role_id);
        $user->save();

        return redirect('panel/user')->with('sucess', 'User is successfully update');
    }
    public function delete($id)
    {
        /*$PermissionRole = PermissionRoleModel::getPermission('Delete User', Auth::user()->role_id);

        if (empty($PermissionRole)) {
            abort(404);
        }*/
        $user = User::getSingle($id);
        $user->delete();
        return redirect('panel/user')->with('success', 'User sucessfully deleted');
    }
}
