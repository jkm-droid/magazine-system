<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Article;
use App\Models\Category;
use Carbon\Carbon;
use Faker\Factory as Faker;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ArticlesController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    //show all the articles while maintaining pagination
    public function index(){
        $articles = Article::with('categories')->latest()->paginate(10);

        return view('dashboard.articles.index', compact('articles'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    //show the edit form / create new article
    public function create_article(){
        //get all the categories
        $categories = Category::get();

        return view('dashboard.articles.create', compact('categories'));
    }

    //save the article after getting details from the
    //form
    public function save_article(Request $request){

        $request->validate([
            'title'=>'required',
            'body'=>'required',
            'image'=>'required|image|file'
        ]);

        $article_info = $request->all();
        //save the image to folder
        $imageName = str_replace(' ','_',$article_info['title']).'.'.$request->image->extension();
        $request->image->move(public_path('article_covers'), $imageName);
        $article_info['image'] = $imageName;

        $article = new Article();
        $user = Admin::find(Auth::user()->id);
        $article->author = $user->name;
        $article->admin_id = $user->id;
        $article->title = $article_info['title'];
        $article->slug = str_replace(" ","-", strtolower($article_info['title']));
        $article->body = $article_info['body'];
        $article->image = $imageName;

        if ($request->has('status')) {
            $article->status = 0;
        } else {
            $article->status = 1;
        }

        //save the article
        $article->save();
        $article->categories()->attach($article_info['category']);

        return redirect()->route('my_articles.index', $user->id)->with('success', 'Article added successfully');
    }

    //show the edit form with an article's content
    public function edit_article($article_id){
        if ($this->check_author($article_id)) {
            $article = Article::find($article_id);
            //get all the categories
            $categories = Category::get();

            return view('dashboard.articles.edit', compact('article'))
                ->with('categories', $categories);
        }

        return redirect()->route('articles.index')->with('error', 'You lack permission to edit article');
    }

    //update the article
    public function update_article(Request $request, $article_id){
        $request->validate([
            'title'=>'required',
            'body'=>'required',
            'category'=>'required'
        ]);

        $article_info = $request->all();
        $article = Article::find($article_id);

        if ($request->hasFile('image')){
            $imageName = str_replace(' ','_',$article_info['title']).'.'.$request->image->extension();
            $request->image->move(public_path('article_covers'), $imageName);
            File::delete($article->image);

            $article_info['image'] = $imageName;
            $article->image = $imageName;
        }

        $article->title = $article_info['title'];
        $article->body = $article_info['body'];
        $article->slug = str_replace(" ","-", strtolower($article_info['title']));
//        $article->updated_at = Carbon::now();

        if ($request->has('status')){
            $article->status = 0;
        }else{
            $article->status = 1;
        }

        //update the article and pivot table
        $article->update();
        $article->categories()->sync([$article_info['category']]);

        return redirect()->route('my_articles.index', Auth::user()->id)->with('success', 'Article updated Successfully');
    }

    //show the article
    public function show_article($article_id){

        $article = Article::find($article_id);

        return view('dashboard.articles.view', compact('article'));
    }

    //delete an article
    public function delete_article($article_id){
        //only the article's author can delete an article
        if ($this->check_author($article_id)) {
            Article::find($article_id)->delete();
            return redirect()->route('articles.index')->with('success', 'Article deleted successfully');
        }

        return redirect()->route('my_articles.index')->with('error', 'You lack permission to delete article');

    }

    //check if the logged user is an article's author
    public function check_author($article_id){
        $user = Admin::find(Auth::user()->id);
        $article = Article::find($article_id);
        if ($user->id == $article->admin_id){
            return true;
        }else{
            return false;
        }
    }

    //find articles for a specific author
    public function my_articles($author_id){
        $articles = Article::with('categories')->where('admin_id', $author_id)->latest()->paginate(10);

        return view('dashboard.articles.my_articles', compact('articles'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function publish_draft_article($article_id){

        $article = Article::find($article_id);
        if ($article->status == 0){
            $article->status = 1;
            $article->update();
            $message = "Article Published successfully";
        }else{
            $article->status = 0;
            $article->update();
            $message = "Article Drafted successfully";
        }

        return redirect()->route('my_articles.index',Auth::user()->id)->with('success', $message);
    }
}
