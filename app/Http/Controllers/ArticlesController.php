<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Article;
use App\Models\Category;
use App\Notifications\PublishPostNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Permissions\HasPermissionsTrait;
use Illuminate\Support\Facades\Redirect;

class ArticlesController extends Controller
{
    /**
     * @var string[]
     */
    public $special_character;

    public function __construct(){
        $this->middleware('auth:admin');
        $this->special_character = array("!", "@", "#", "$", "%", "^", "&", "*", "(", ")", ",", "/", "{", "}", "[", "]", "?");
    }

    //show all the articles while maintaining pagination
    public function index(){
        $articles = Article::with('categories')->latest()->paginate(10);

        return view('dashboard.articles.index', compact('articles'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    //show the edit form / create new article
    public function create_article(Request $request){
        if ($request->user('admin')->can('create-article')) {
            //get all the categories
            $categories = Category::get();

            return view('dashboard.articles.create', compact('categories'));
        }

        return Redirect::back()->with('error', 'You lack permission to perform the action');
    }

    //save the article after getting details from the
    //form
    public function save_article(Request $request){

        $request->validate([
            'title' => 'required|unique:articles',
            'category'=> 'required',
            'body' => 'required',
            'image' => 'required|image|file'
        ]);

        $article_info = $request->all();
        //save the image to folder
        $imageName = str_replace($this->special_character, '', $article_info['title']);
        $request->image->move(public_path('article_covers'), $imageName);
        $article_info['image'] = $imageName;

        $article = new Article();
        $user = Admin::find(Auth::user()->id);
        $article->author = "Industrialising Africa";
        $article->admin_id = $user->id;
        $article->title = $article_info['title'];
        $special_slug = str_replace($this->special_character, "", strtolower($article_info['title']));
        $article->slug = str_replace(' ', '_',$special_slug);
        $article->type = $article_info['type'];
        $article->body = $article_info['body'];
        $article->image = $imageName;
        $article->status = 0;

        //save the article
        $article->save();

        $article->categories()->attach($article_info['category']);
        //send notification to admin
        $this->send_notification($article);

        return redirect()->route('my_articles.index', $user->id)->with('success', 'Article added successfully');
    }

    //send the notification to admin to publish the article
    public function send_notification($article){

        $admins = Admin::where('is_admin',1)->get();
        Notification::send($admins, new PublishPostNotification($article));
    }

    //show the edit form with an article's content
    public function edit_article($article_id){

        $article = Article::find($article_id);
        //get all the categories
        $categories = Category::get();
//dd($article->categories);
        return view('dashboard.articles.edit', compact('article'))
            ->with('categories', $categories);
    }

    //update the article
    public function update_article(Request $request, $article_id){
        $request->validate([
            'title'=>'required',
            'body'=>'required',
            'category'=>'required',
            'type'=>'required'
        ]);

        $article_info = $request->all();
        $article = Article::find($article_id);

        if ($request->hasFile('image')){
            $special_char = array("!", "@", "#", "$", "%", "^", "&", "*", "(", ")", ",", "/", "{", "}", "[", "]", "?");
            $imageName = str_replace($special_char, '', $article_info['title']);
            $imageName = str_replace(' ', '_',$imageName) . '.' . $request->image->extension();
            $request->image->move(public_path('article_covers'), $imageName);
            File::delete($article->image);

            $article_info['image'] = $imageName;
            $article->image = $imageName;
        }

        $article->title = $article_info['title'];
        $article->body = $article_info['body'];
        $special_slug = str_replace($this->special_character, "", strtolower($article_info['title']));
        $article->slug = str_replace(' ', '_',$special_slug);
        $article->type = $article_info['type'];
        $article->author = "Industrialising Africa";

        //update the article and pivot table
        $article->update();
        $article->categories()->sync([$article_info['category']]);

        return redirect()->route('my_articles.index', Auth::user()->id)->with('success', 'Article updated Successfully');
    }

    //show the article
    public function show_article($article_id){

        $article = Article::findOrFail($article_id);

        return view('dashboard.articles.view', compact('article'));
    }

    //delete an article
    public function delete_article($article_id){

        $author_id = Auth::user()->id;

        Article::find($article_id)->delete();

        return redirect()->route('my_articles.index',$author_id)->with('success', 'Article deleted successfully');

    }

    //find articles for a specific author
    public function my_articles($author_id){

        $articles = Article::with('categories')->where('admin_id', $author_id)->latest()->paginate(10);

        return view('dashboard.articles.my_articles', compact('articles'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function publish_draft_article(Request $request,$article_id){
//        if ($request->user('admin')->can('publish-article')) {
        if (Auth::user()->isSuperAdmin == 1){
            $article = Article::find($article_id);
            if ($article->status == 0) {
                $article->status = 1;
                $article->update();
                $message = "Article Published successfully";
            } else {
                $article->status = 0;
                $article->update();
                $message = "Article Drafted successfully";
            }

            return redirect()->route('articles.index', Auth::user()->id)->with('success', $message);
        }

        return Redirect::back()->with('error', 'You lack permission to do this action');
    }
}
