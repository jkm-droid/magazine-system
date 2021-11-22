<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function dashboard(){
        $total_articles = Article::count();
        $total_admins = Admin::count();

        $author_articles = Article::where('author', Auth::user()->name)->count();

        $recent_articles = Article::latest()->take(4)->get();
        $recent_categories = Category::latest()->take(4)->get();

        $registered_users = User::count();

        return view('dashboard.dashboard', compact('recent_articles','recent_categories'))
            ->with('total_articles', $total_articles)
            ->with('total_users', $registered_users)
            ->with('author_articles', $author_articles)
            ->with('i', 1)
            ->with('total_admins', $total_admins);
    }
}
