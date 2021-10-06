<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    //the function displays the homepage content
    public function show_index_page(){
        $feature_article = Article::with('categories')->where('status',1)->inRandomOrder()->limit(1)->get();
        $more_articles = Article::with('categories')->where('status',1)->inRandomOrder()->limit(3)->get();
        $articles = Article::with('categories')->where('status',1)->latest()->paginate(5);

        return view('site.home', compact('articles'))
        ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('feature_article', $feature_article)
            ->with('more_articles', $more_articles)
            ->with('categories', $this->get_categories());
    }

    //render a full article based on its slug
    public function show_full_article($slug){
        $article = Article::with('categories')->where('slug', $slug)->get();

        return view('site.full_article', compact('article'))
            ->with('categories', $this->get_categories());
    }

    //get the categories
    public function get_categories(){
        return Category::with('articles')->inRandomOrder()->limit(7)->get();
    }

    public function get_category_articles($category_id){
        $categories = Category::with('articles')->where('id', $category_id)->get();
        $art_title = '';
        $cat_articles = '';
        foreach ($categories as $category){
            $cat_articles = $category->articles;
        }
        return response()->json($cat_articles);
    }

}
