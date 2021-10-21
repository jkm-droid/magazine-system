<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{

    use AuthenticatesUsers;

    public function __construct(){
        $this->middleware('guest:admin')->except('logout', 'admin_logout');
    }

    //show the index page
    public function admin_show_login(){
        return view('admin.login')->with('all_categories', Category::get());
    }

    public function admin_login(Request $request){

        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);

        $info = $request->all();

        $credentials = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if(Auth::guard('admin')->attempt(array($credentials=>$info['username'], 'password'=>$info['password']))){
            return redirect()->intended('dashboard')->with('success', 'logged in successfully');
        }

        return redirect()->route('admin.show.login')->with('error', 'Error, login details are incorrect');
    }

    public function admin_show_register(){
        return view('admin.register');
    }

    public function register(Request $request){
        $request->validate([
            'username'=>'required',
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
        ]);

        $user_data = $request->all();
        $this->create($user_data);

        return redirect()->route('show.login')->with('success', 'Registered successfully, you can now login');
    }

    public function create(array $data){
        return Admin::create([
            'username'=>$data['username'],
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password'])
        ]);
    }

    public function admin_logout(Request $request){
        if (Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
            $request->session()->invalidate();

            return redirect()->route('admin.show.login')->with('success', 'Logged out successfully');
        }else {
            Auth::logout();
            Session::flush();

            $request->session()->invalidate();
            return redirect()->route('show.login')->with('success', 'Logged out successfully');
        }
    }
}
