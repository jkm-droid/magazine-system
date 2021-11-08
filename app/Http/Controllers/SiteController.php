<?php

namespace App\Http\Controllers;

use App\HelperFunctions\GetCategories;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Category;
use App\Models\Magazine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SiteController extends Controller
{
    use GetCategories;

    public function __construct(){
        $this->middleware('guest:admin')->except('logout', 'admin_logout');
    }

    /**
     * show the home page
     */
    public function show_index_page(){

        $data = '{
        "result":1,
        "message":"Successfully retrieved payment details.",
        "details":{"merchantTransactionID":"321",
        "checkoutRequestID":"16606006",
        "receiptNumber":"321rc1636138530",
        "amountPaid":"1.0000","currencyCode":"KES",
        "serviceCode":"FIRSTCODE","accountNumber":"254700861587_321","serviceChargeAmount":"0.0000","today":"2021-11-05 21:55:30",
        "acknowledged":"true",
        "payments":[{
        "cpgTransactionID":"1174897182","merchantTransactionID":"321",
        "payerClientName":"Safaricom Kenya Limited","MSISDN":"254700861587","currencyCode":"KES","amountPaid":"1.0000",
        "serviceCode":"FIRSTCODE","payerTransactionID":"PK549JZD26","hubOverallStatus":"139",
        "accountNumber":"254700861587_321","customerName":"Customer","payerClientCode":"SAFKE","datePaymentReceived":"2021-11-05 18:55:25"}]}}';

        return view('site.home')
            ->with('categories', $this->get_categories())
            ->with('all_categories', $this->get_all_categories())
            ->with('one_category', $this->get_one_category())
            ->with('not_search_form', "false");
    }

    /**
     * show the about us page
     */
    public function show_about_page(){

        return view('site.about')
            ->with('categories', $this->get_categories())
            ->with('all_categories', $this->get_all_categories())
            ->with('one_category', $this->get_one_category());
    }

    /**
     * show the about us page
     */
    public function show_faqs_page(){

        return view('site.faqs')
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
        $this->show_full_article($slug);
    }

    /**
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
        $request->validate([
            'search'=> 'required'
        ]);

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

    /**
     * show the archives page, magazine issues
     */
    public function show_archives_page(){

        $magazines = Magazine::where('published',1)->get();

        return view('site.magazine', compact('magazines'))
            ->with('categories', $this->get_categories())
            ->with('all_categories', $this->get_all_categories())
            ->with('one_category', $this->get_one_category());
    }

    /**
     * show payment success
     */
    public function post_from_tingg(){
        return redirect()->route('site.success.show');
    }

    public function show_success_page(){
        return view('site.success');
    }

}
