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
     * Get seven categories for the carousel section
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

    /**
     * get 7 leading articles
     */
    public function get_seven_leading_articles(){
        return Article::where('type','premium')->where('language','english')->where('status',1)->inRandomOrder()->get();
    }

    /**
     * get 7 leading french articles
     */
    public function get_seven_leading_french_articles(){
        return Article::where('type','premium')->where('language','francais')->where('status',1)->inRandomOrder()->get();
    }

}
