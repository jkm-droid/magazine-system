<?php

namespace App\Http\Controllers;

use App\HelperFunctions\GetCategories;
use App\Models\Article;
use App\Models\Category;
use App\Models\Magazine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PremiumSiteController extends Controller
{
    use GetCategories;

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * display the authenticated home page
     */
    public function portal(){
//        $user = User::find(Auth::user()->id);
//        if ($user->payment_status == 0){
//            return redirect()->route('show.subscribe', $user->email);
//        }

        $feature_article = Article::with('categories')->where('status',1)->inRandomOrder()->limit(1)->first();
        $articles = Article::with('categories')->where('status',1)->latest()->paginate(5);

        return view('premium_site.portal', compact('articles'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('feature_article', $feature_article)
            ->with('categories', $this->get_categories())
            ->with('all_categories', $this->get_all_categories())
            ->with('one_category', $this->get_one_category());
    }

    /**
     * show a full article based on its slug
     */

    public function show_full_premium_article($slug){
        $article = Article::with('categories')->where('slug', $slug)->first();

        //get articles belonging to the author
        $author_articles = Article::with('categories')->where('author',$article->author)->where('status',1)->get();

        return view('premium_site.full_article', compact('article','author_articles'))
            ->with('categories', $this->get_categories())
            ->with('all_categories', $this->get_all_categories())
            ->with('one_category', $this->get_one_category());
    }

    /**
     * Get all the articles belonging to a particular category
     */
    public function get_all_premium_articles_per_category($category_slug){
        $category_articles = Category::with('articles')->where('slug', $category_slug)->latest()->get();
        $cat_articles = '';
        $category_title = '';

        foreach ($category_articles as $category){
            $cat_articles = $category->articles()->where('status', 1)->latest()->paginate(5);
            $category_title = $category->title;
        }

        return view('premium_site.category_articles', compact('cat_articles'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('categories', $this->get_categories())
            ->with('all_categories', $this->get_all_categories())
            ->with('category_title', $category_title)
            ->with('one_category', $this->get_one_category());
    }

    /**
     * search for articles based on keywords
     */
    public function search_articles(Request $request){
        $request->validate([
            'search'=> 'required'
        ]);

        $search_term = trim($request->search);
        $results = DB::table('articles')
            ->where('title', 'LIKE','%'.$search_term.'%')
            ->orWhere('author', 'LIKE','%'.$search_term.'%')->latest()->paginate(10);

        return view('premium_site.search_results', compact('results'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('categories', $this->get_categories())
            ->with('all_categories', $this->get_all_categories())
            ->with('one_category', $this->get_one_category());
    }

    /**
     * show the magazine page, magazine issues
     */
    public function show_magazine(){

        $magazines = Magazine::where('published',1)->get();

        return view('premium_site.magazine', compact('magazines'))
            ->with('categories', $this->get_categories())
            ->with('all_categories', $this->get_all_categories())
            ->with('one_category', $this->get_one_category());
    }

    /**
     * read the magazine
     */
    public function read_magazine($magazine_slug){
        $user = User::find(Auth::user()->id);
        if ($user->payment_status == 1) {
            $magazine = Magazine::where('slug', $magazine_slug)->first();

            return view('premium_site.read_magazine')
                ->with('magazine', $magazine)
                ->with('categories', $this->get_categories())
                ->with('all_categories', $this->get_all_categories())
                ->with('one_category', $this->get_one_category());
        }

        return view('payments.subscription_plan', compact('user'));
    }
}
