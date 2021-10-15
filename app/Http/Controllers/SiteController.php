<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function __construct(){
        $this->middleware('guest:admin')->except('logout', 'admin_logout');
    }

    public function show_index_page(){
        return view('site.home')
            ->with('categories', $this->get_categories())
            ->with('all_categories', $this->get_all_categories())
            ->with('one_category', $this->get_one_category());
    }

    /**
     * the function displays the homepage content
     */
    public function show_articles_page(){
        $feature_article = Article::with('categories')->where('status',1)->inRandomOrder()->limit(1)->get();
        $more_articles = Article::with('categories')->where('status',1)->inRandomOrder()->limit(3)->get();
        $articles = Article::with('categories')->where('status',1)->latest()->paginate(5);
//dd($this->get_all_categories());
        return view('site.articles', compact('articles'))
        ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('feature_article', $feature_article)
            ->with('more_articles', $more_articles)
            ->with('categories', $this->get_categories())
            ->with('all_categories', $this->get_all_categories())
            ->with('one_category', $this->get_one_category());
    }

    /**
     *  render a full article based on its slug
     */
    public function show_full_article($slug){
        $article = Article::with('categories')->where('slug', $slug)->get();

        //get articles belonging to the author
        $author_articles = Article::with('categories')->where('author',$article[0]->author)->get();

        return view('site.full_article', compact('article','author_articles'))
            ->with('categories', $this->get_categories())
            ->with('all_categories', $this->get_all_categories())
            ->with('one_category', $this->get_one_category());
    }

    /**
     * @param $category_slug
     * Get all the articles belonging to a particular category
     */
    public function get_all_articles_per_category($category_slug){
        $category_articles = Category::with('articles')->where('slug', $category_slug)->latest()->get();
        $cat_articles = '';
        $category_title = '';

        foreach ($category_articles as $category){
            $cat_articles = $category->articles()->where('status', 1)->latest()->paginate(5);
            $category_title = $category->title;
        }

        return view('site.category_articles', compact('cat_articles'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('categories', $this->get_categories())
            ->with('all_categories', $this->get_all_categories())
            ->with('category_title', $category_title)
            ->with('one_category', $this->get_one_category());
    }

    /**
     * @return mixed
     * Get all the categories for the category drop down menu
     */
    public function get_all_categories(){
        return Category::get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     * Get seven categories for the mega drop down menu
     */
    public function get_categories(){
        return Category::with('articles')->inRandomOrder()->take(7)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed|string
     * Get one category
     */
    public function get_one_category(){
        $categories = Category::with('articles')->inRandomOrder()->take(1)->get();

        $cat_articles = '';
        foreach ($categories as $category){
            $cat_articles = $category->articles;
        }

        return $cat_articles;
    }

    /**
     * @param $category_id
     * @return \Illuminate\Http\JsonResponse
     * Get the articles belonging to a certain category
     */
    public function get_category_articles($category_id){
        $categories = Category::with('articles')->where('id', $category_id)->get();

        $cat_articles = '';
        foreach ($categories as $category){
            $cat_articles = $category->articles;
        }
        return response()->json($cat_articles);
    }

    /**
     * search for articles based on keywords
     */
    public function search_articles(Request $request){
        $search_term = trim($request->search);
        $results = DB::table('articles')
            ->where('title', 'LIKE','%'.$search_term.'%')
            ->orWhere('author', 'LIKE','%'.$search_term.'%')->latest()->paginate(10);

        return view('site.search_results', compact('results'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('categories', $this->get_categories())
            ->with('all_categories', $this->get_all_categories())
            ->with('one_category', $this->get_one_category());
    }
}
