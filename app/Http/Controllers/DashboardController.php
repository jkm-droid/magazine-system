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

        return view('dashboard.admin')
            ->with('total_articles', $total_articles)
            ->with('total_categories', $total_categories)
            ->with('total_admins', $total_admins);
    }
}
