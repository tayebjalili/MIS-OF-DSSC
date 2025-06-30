<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleModel;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\BaseController;

class RoleController extends  BaseController
{
  public function list(Request $request)
{
    $search = $request->input('search');
    $sortBy = $request->input('sort_by', 'id');    // Default sort column: id
    $order = $request->input('order', 'asc');      // Default order: ascending

    $query = RoleModel::query();

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%$search%")
              ->orWhere('id', 'like', "%$search%");
        });
    }

    // Apply sorting only if the column is allowed
    if (in_array($sortBy, ['id', 'name'])) {
        $query->orderBy($sortBy, $order);
    }

    // Paginate results
    $data['getRecord'] = $query->paginate(10)->appends([
        'search' => $search,
        'sort_by' => $sortBy,
        'order' => $order,
    ]);

    // Pass current sort parameters to view for UI state (like arrows)
    $data['currentSortBy'] = $sortBy;
    $data['currentOrder'] = $order;

    return view('panel.roles.list', $data);
}



    public function add()
    {

        $getPermissionModel = PermissionModel::getRecord();
        $data['getPermission'] = $getPermissionModel; // Corrected line
        return view('panel.roles.add', $data);
    }

    public function insert(Request $request)
    {



        $validPermissions = PermissionModel::whereIn('id', $request->permission_id)->pluck('id')->toArray();
        if (count($validPermissions) !== count($request->permission_id)) {
            return redirect()->back()->withErrors('Some selected permissions are invalid.');
        }




        $save = new RoleModel;
        $save->name = $request->name;
        $save->save();

        PermissionRoleModel::InserUpdateRecord($request->permission_id, $save->id); //i fix the code like the video like change InsertUpdateRecord to InserUpdateRecord to it

        return redirect('panel/roles')->with('success', 'Role sucessfully created');
    }

    public function edit($id)
    {


        // Fetch the role record
        $data['getRecord'] = RoleModel::findOrFail($id);  // Using findOrFail to ensure the record exists

        // Get all permissions, grouped by 'groupby'
        $data['getPermission'] = PermissionModel::all()->groupBy('groupby'); // Group permissions by 'groupby'

        // Get permissions already assigned to the role
        $data['getRolePermission'] = PermissionRoleModel::where('role_id', $id)->get(); // Fetch role's permissions

        return view('panel.roles.edit', $data);
    }

    public function update($id, Request $request)
    {


        $save = RoleModel::getSingle($id);
        $save->name = $request->name;
        $save->save();

        PermissionRoleModel::InserUpdateRecord($request->permission_id, $save->id);



        return redirect('panel/roles/')->with('success', 'Role sucessfully updated');
    }


    public function delete($id)
    {

        $save = RoleModel::getSingle($id);
        $save->delete();
        return redirect('panel/roles')->with('success', 'Role sucessfully deleted');
    }
    public function setLanguage($lang)
    {
        $availableLanguages = ['en', 'ps', 'fa'];

        if (in_array($lang, $availableLanguages)) {
            session()->put('locale', $lang);
            App::setLocale($lang);
        } else {
            session()->put('locale', 'en');
            App::setLocale('en');
        }

        return redirect()->back();
    }
}
