<?php
namespace App\HelperFunctions;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

trait GetCategories{
    /**
     * Get all the categories for the category drop down menu
     */
    public function get_all_categories(){
        return Category::get();
    }

    /**
     * Get seven categories for the mega drop down menu
     */
    public function get_categories(){
        return Category::with('articles')->inRandomOrder()->take(7)->get();
    }

    /**
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

}
