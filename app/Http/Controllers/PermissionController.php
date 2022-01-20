<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    //get all the permissions and render to blade
    public function index(){
        $permissions = Permission::latest()->paginate(10);

        return view('dashboard.permissions.index',compact('permissions'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    //show the form for creating a new permission
    public function create_permission(){
        return view('dashboard.permissions.create');
    }

    //save a permission to db
    public function save_permission(Request $request){

        $request->validate([
            'name'=>'required',
        ]);

        $permission_data = $request->all();
        $permission = new Permission();
        $permission->name = trim($permission_data['name']);
        $permission->slug = Str::lower(trim($permission_data['name']));
        $permission->author = Auth::user()->name;

        $permission->save();

        return redirect()->route('permission.index')->with('success', 'Permission Saved Successfully');
    }

    //show the edit form
    public function edit_permission($permission_id){
        $permission = Permission::find($permission_id);

        return view('dashboard.permissions.edit', compact('permission'));
    }

    //edit a given permission
    public function update_permission(Request $request,$permission_id){
        $request->validate([
            'name'=>'required'
        ]);

        $permission = Permission::find($permission_id);
        $permission->name = trim($request->name);
        $permission->slug = Str::lower($request->name);

        $permission->update();

        return redirect()->route('permission.index')->with('success', 'Permission Updated Successfully');
    }
}
