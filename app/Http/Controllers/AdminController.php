<?php

namespace App\Http\Controllers;

use App\Jobs\SendAdminCreationEmailJob;
use App\Models\Admin;
use App\Models\Role;
use http\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    //show all the authors and associated roles
    public function index(){
        $admins = Admin::with('roles')->latest()->paginate(10);

        return view('dashboard.admins.index', compact('admins'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    //show admin edit form
    public function edit_admin($admin_id){
        $admin = Admin::with('roles')->find($admin_id);
        $roles = Role::get();

        return view('dashboard.admins.edit', compact('roles','admin'));
    }

    //update admin / assign roles
    public function update_admin(Request $request, $admin_id){
        $request->validate([
            'role'=>'required'
        ]);

        $admin = Admin::find($admin_id);

        $user_roles = $request->role;
        for ($r = 0;$r < count($user_roles);$r++) {
            $admin->roles()->sync([$user_roles[$r]]);
        }

        return redirect()->route('admin.index')->with('success','Role assigned successfully');
    }

    //create a new admin
    public function create_admin(){
        return view('dashboard.admins.create');
    }

    //send invitation link
    public function send_admin_invite_link(Request $request){
        $request->validate([
            'email'=>'required|email'
        ]);

        $email_address = trim($request->email);
        $link = route('admin.show.register');

        SendAdminCreationEmailJob::dispatch($email_address, $link);

        return redirect()->route('admin.index')->with('success', 'Email sent successfully');
    }

    //change admin status -> super admin or <- normal admin
    public function make_super_admin($admin_id){
        $auth_admin_id = Auth::user()->id;
        $admin = Admin::find($admin_id);

        if ($auth_admin_id == $admin->id){
            return Redirect::back()->with('error','You cannot perform this operation');
        }
        $message = '';
        if ($admin->isSuperAdmin == 1){
            $admin->isSuperAdmin = 0;
            $message = "Demoted Successfully";
        }elseif($admin->isSuperAdmin == 0){
            $admin->isSuperAdmin = 1;
            $message = "Promoted Successfully";
        }

        $admin->update();

        return Redirect::back()->with('success', $message);
    }
}
