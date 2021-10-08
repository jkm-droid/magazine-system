<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RoleController extends Controller
{

    public function __construct(){
        $this->middleware('auth:admin');
    }

    //get all the roles and render to blade
    public function index(){
        $roles = Role::with('permissions')->latest()->paginate(10);

        return view('dashboard.roles.index',compact('roles'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    //show the form for creating a new role
    public function create_role(){
        //get all the permissions
        $permissions = Permission::get();
        return view('dashboard.roles.create', compact('permissions'));
    }

    //save a role to db
    public function save_role(Request $request){

        $request->validate([
            'name'=> 'required',
            'permission'=> 'required'
        ]);

        $role_data = $request->all();
        $role = new Role();
        $role->name = trim($role_data['name']);
        $role->slug = Str::lower(trim($role_data['name']));
        $role->author = Auth::user()->name;
        //save the role
        $role->save();

        //get a permission or array of permissions
        $permisions = $request->permission;

        for($p = 0;$p < count($permisions);$p++){
            $role->permissions()->attach($permisions[$p]);
        }

        return redirect()->route('role.index')->with('success', 'Role Saved Successfully');
    }

    //show a single role
    public function show_role($slug){
        $role = Role::where('slug',$slug)->with('permissions')->first();

        return view('dashboard.roles.view', compact('role'));
    }

    //edit role
    public function edit_role($slug){
        $role = Role::with('permissions')->where('slug',$slug)->first();
        $all_permissions = Permission::get();

        //create collection for permissions
        $role_perm = collect($role->permissions)->toArray();
        $all_perm = collect($all_permissions)->toArray();

        $role_array = array();
        $all_array = array();

        foreach ($role_perm as $rp){
            array_push($role_array, $rp['slug']);
        }

        foreach ($all_perm as $alp){
            array_push($all_array,$alp['slug']);
        }

        $new_permissions = array_values(array_diff($all_array,$role_array));

        return view('dashboard.roles.edit', compact('role','new_permissions'));
    }

    //update a role
    public function update_role(Request $request, $role_id){

        $request->validate([
            'name'=> 'required',
        ]);

        $role = Role::find($role_id);
        $role_name = $request->name;
        $role->name = trim($role_name);
        $role->slug = Str::lower(trim($role_name));
        $role->author = Auth::user()->name;
        //save the role
//        $role->update();

        //get a permission or array of permissions
        if ($request->has('permission')) {
            $permisions = $request->permission;

            for ($p = 0; $p < count($permisions); $p++) {

                $perm = Permission::where('slug',$permisions[$p])->first();
                $role->permissions()->toggle([$perm->id]);
            }

        }

        return redirect()->route('role.index')->with('success', 'Role Updated Successfully');
    }
}
