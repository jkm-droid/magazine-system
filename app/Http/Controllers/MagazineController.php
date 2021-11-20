<?php

namespace App\Http\Controllers;

use App\Models\Magazine;
use App\Models\MagazineArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;


class MagazineController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    /**
     * render the magazine index page
     */
    public function index(){
        $magazines = Magazine::latest()->paginate(10);

        return view('dashboard.magazines.index', compact('magazines'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * show the magazine creation form
     */
    public function create_magazine(){
//        dd(phpinfo());
        return view('dashboard.magazines.create');
    }

    /**
     * save the magazine
     */
    public function save_magazine(Request $request){
        $request->validate([
            'title'=>'required',
            'issue'=>'required',
            'copy'=>'required|mimes:pdf',
            'image'=>'required|image'
        ]);

        $magazine_info = $request->all();
        //save the image to folder
        $imageName = str_replace(' ', '_', $magazine_info['title']) . '.' . $request->image->extension();
        $request->image->move(public_path('magazine_covers'), $imageName);
        $magazine_info['image'] = $imageName;

        //save the magazine copy to folder
        $copyName = str_replace(' ', '_', $magazine_info['title']) . '.' . $request->copy->extension();
        $request->copy->move(public_path('magazine_copies'), $copyName);
        $magazine_info['copy'] = $copyName;

        $magazine = new Magazine();
        $magazine->title = $magazine_info['title'];
        $magazine->issue = $magazine_info['issue'];
        $magazine->image = $imageName;
        $magazine->slug = str_replace(' ','-', Str::lower($magazine_info['title']));
        $magazine->copy = $copyName;
        $magazine->document_name = $copyName;

        //save the magazine
        $magazine->save();

        return redirect()->route('magazines.index')->with('success','Magazine Created successfully');
    }

    /**
     * upload large files
     */
    public function upload_magazine_digital_copy(Request $request){

    }

    /**
     * return the show magazine page
     */
    public function show_magazine($magazine_id){
        $magazine = Magazine::find($magazine_id);

        return view('dashboard.magazines.view')->with('magazine',$magazine)->with('i',1);
    }

    /**
     * show the magazine edit form/page
     */
    public function edit_magazine($magazine_id){
        $magazine = Magazine::find($magazine_id);

        return view('dashboard.magazines.edit', compact('magazine'));
    }

    /**
     * update the magazine
     */
    public function update_magazine(Request $request, $magazine_id){
        $request->validate([
            'title'=>'required',
            'issue'=>'required',
        ]);

        $magazine = Magazine::find($magazine_id);
        $magazine_data = $request->all();

        if ($request->hasFile('image')){
            //save the magazine image to folder
            $imageName = str_replace(' ','_',$magazine_data['title']).'.'.$request->image->extension();
            $request->image->move(public_path('magazine_covers'), $imageName);
            File::delete($magazine->image);

            $magazine_data['image'] = $imageName;
            $magazine->image = $imageName;

        }

        if ($request->hasFile('copy')){
            //save the magazine copy to folder
            $copyName = str_replace(' ', '_', $magazine_data['title']) . '.' . $request->copy->extension();
            $request->copy->move(public_path('magazine_copies'), $copyName);
            File::delete($magazine->copy);

            $magazine_data['copy'] = $copyName;
            $magazine->copy = $copyName;
        }

        $magazine->title = $magazine_data['title'];
        $magazine->issue = $magazine_data['issue'];
        $magazine->slug = str_replace(' ','-', Str::lower($magazine_data['title']));

        $magazine->update();

        return redirect()->route('magazines.index')->with('success','Magazine updated successfully');

    }

    /**
     * delete a magazine
     */
    public function delete_magazine($magazine_id){
        Magazine::find($magazine_id)->delete();

        return redirect()->route('magazines.index')->with('success','Magazine deleted successfully');
    }

    /**
     * publish or draft (un-publish) a magazine
     */
    public function publish_draft_magazine($magazine_id){
        $magazine = Magazine::find($magazine_id);

        if (Auth::user()->isSuperAdmin == 1) {
            if ($magazine->published == 1) {
                $magazine->published = 0;
                $message = "Magazine un-published successfully";
            } else {
                $magazine->published = 1;
                $message = "Magazine Published successfully";
            }

            $magazine->update();

            return redirect()->route('magazines.index')->with('success', $message);
        }

        return Redirect::back()->with('error', 'You lack permission to do this action');
    }

    /**
     * add an article belonging to a magazine
     */

    public function add_magazine_article(Request $request, $magazine_id){
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'image'=>'required|image'
        ]);

        $magazine_article_info = $request->all();
        //save the image to folder
        $imageName = str_replace(' ', '_', $magazine_article_info['title']) . '.' . $request->image->extension();
        $request->image->move(public_path('magazine_covers'), $imageName);
        $magazine_article_info['image'] = $imageName;

        //find the associated magazine
        $magazine = Magazine::find($magazine_id);

        //create a new magazine article
        $magazine_article = new MagazineArticle();
        $magazine_article->title = $magazine_article_info['title'];
        $magazine_article->description = $magazine_article_info['description'];
        $magazine_article->image = $imageName;

        $magazine->magazine_articles()->save($magazine_article);

        return redirect()->route('magazine.show', $magazine_id)->with('success','Article added successfully');
    }

    /**
     * edit a magazine article
     */
    public function edit_magazine_article($magazine_article_id){
        $magazine_article = MagazineArticle::find($magazine_article_id);

        return view('dashboard.magazines.edit_article')->with('magazine_article',$magazine_article);
    }

    /**
     * update a magazine article
     */
    public function update_magazine_article(Request $request, $magazine_article_id){
        $request->validate([
            'title'=>'required',
            'description'=>'required'
        ]);

        //find the magazine article
        $magazine_article = MagazineArticle::find($magazine_article_id);
        //find the magazine
        $magazine = Magazine::find($magazine_article->magazine->id);
        //request all the form details
        $magazine_article_info = $request->all();

        if ($request->hasFile('image')){
            $imageName = str_replace(' ','_',$magazine_article_info['title']).'.'.$request->image->extension();
            $request->image->move(public_path('magazine_covers'), $imageName);
            File::delete($magazine_article->image);

            $magazine_article_info['image'] = $imageName;
            $magazine_article->image = $imageName;
        }

        $magazine_article->title = $magazine_article_info['title'];
        $magazine_article->description = $magazine_article_info['description'];

        $magazine->magazine_articles()->save($magazine_article);

        return redirect()->route('magazine.show', $magazine->id)->with('success', 'Article updated successfully');
    }

    /**
     * delete a magazine article
     */
    public function delete_magazine_article($magazine_article_id){
        //get the magazine article
        $magazine_article = MagazineArticle::find($magazine_article_id);
        $magazine_article->delete();
        //find the magazine
        $magazine = Magazine::find($magazine_article->magazine->id);

        return redirect()->route('magazine.show', $magazine->id)->with('success', 'Article deleted successfully');
    }

}
