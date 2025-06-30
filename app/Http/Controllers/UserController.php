<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleModel;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\App;
use App\Http\Controllers\BaseController;

class UserController extends  BaseController
{
    // public function list()
    // {
    //

    //     // $data['getRecord'] = User::getRecord();
    //     $data['getRecord'] = User::getRecord();
    //     return view('panel.user.list', $data);
    // }
  public function list(Request $request)
{
    $search = $request->input('search');
    $sortBy = $request->input('sort_by', 'id'); // default sort column
    $order = $request->input('order', 'asc');  // default order

    $allowedSorts = ['id', 'name', 'email']; // whitelist to prevent SQL injection
    if (!in_array($sortBy, $allowedSorts)) {
        $sortBy = 'id';
    }
    if (!in_array(strtolower($order), ['asc', 'desc'])) {
        $order = 'asc';
    }

    $query = User::query();

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%$search%")
              ->orWhere('email', 'like', "%$search%")
              ->orWhere('id', 'like', "%$search%");
        });
    }

    // Apply sorting
    $query->orderBy($sortBy, $order);

    $data['getRecord'] = $query->paginate(10)->appends([
        'search' => $search,
        'sort_by' => $sortBy,
        'order' => $order,
    ]);

    // Send current sorting info to the view
    $data['currentSortBy'] = $sortBy;
    $data['currentOrder'] = $order;
    $data['search'] = $search;

    return view('panel.user.list', $data);
}



    public function add()
    {

        $data['getRole'] = RoleModel::getRecord();

        return view('panel.user.add', $data);
    }

    public function edit($id)
    {


        $data['getRecord'] = User::findOrFail($id);

        $data['getRole'] = RoleModel::getRecord();
        return view('panel.user.edit', $data);
    }
    public function insert(Request $request)
    {

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

        $user = User::getSingle($id);
        $user->delete();
        return redirect('panel/user')->with('success', 'User sucessfully deleted');
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
