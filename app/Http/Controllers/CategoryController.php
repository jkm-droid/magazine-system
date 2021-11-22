<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    //show all the categories while maintaining pagination
    public function index(){
        $categories = Category::latest()->paginate(10);

        return view('dashboard.categories.index', compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    //show the category creation form
    public function create_category(){

        return view('dashboard.categories.create');
    }

    //add a new category
    public function save_category(Request $request){
        $request->validate([
            'title'=> 'required | unique:categories',
            'image' => 'required|image|file'
        ]);

        $data = $request->all();
        $category = new Category();

        //save the image to folder
        if ($request->hasFile('image')) {
            $imageName = str_replace(' ', '_', $data['title']) . '.' . $request->image->extension();
            $request->image->move(public_path('category_covers'), $imageName);
            $data['image'] = $imageName;
            $category->image = $imageName;
        }else{
            $faker = Faker::create('App\Category');
            $faker->image(public_path('category_covers'), 900, 400, null, false);
            $category->image = str_replace(' ', '_', $data['title']);
        }

        $category->title = ucfirst($data['title']);
        $category->slug = str_replace(" ", "-", strtolower($data['title']));
        $category->admin_id = Auth::user()->id;
        $category->author = Auth::user()->name;
        $category->save();

        return redirect()->route('categories.index')->with('success','Category created successfully');
    }

    //show the category edit form
    public function edit_category($category_id){
        $category = Category::find($category_id);

        return view('dashboard.categories.edit', compact('category'));
    }

    //update the category
    public function update_category(Request $request, $category_id){
        $request->validate([
            'title'=>'required'
        ]);

        $data = $request->all();
        $category = Category::find($category_id);

        if ($request->hasFile('image')){
            $imageName = str_replace(' ','_',$data['title']).'.'.$request->image->extension();
            $request->image->move(public_path('category_covers'), $imageName);
            File::delete($data['image']);

            $data['image'] = $imageName;
            $category->image = $imageName;
        }else{
            $faker = Faker::create('App\Category');
            $image = $faker->image(public_path('category_covers'), 900, 400, null, false);
            $category->image = str_replace(' ', '_', $data['title']);
        }

        $category->title = ucfirst($data['title']);
        $category->slug = str_replace(" ", "-", strtolower($data['title']));
        //update the category
        $category->update();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    //delete a single category
    public function delete_category($category_id){
        Category::find($category_id)->delete();

        return redirect()->route('categories.index')->with('success', 'Category delete successfully');
    }
}
