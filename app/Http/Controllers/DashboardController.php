<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function dashboard(){
        $total_articles = Article::count();
        $total_categories = Category::count();
        $total_admins = Admin::count();

        $recent_articles = Article::latest()->take(4)->get();
        $recent_categories = Category::latest()->take(4)->get();

        return view('dashboard.dashboard', compact('recent_articles','recent_categories'))
            ->with('total_articles', $total_articles)
            ->with('total_categories', $total_categories)
            ->with('i', 1)
            ->with('total_admins', $total_admins);
    }
}
