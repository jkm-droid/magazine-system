<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'title',
        'body',
        'author',
        'image',
        'slug'
    ];

    /**
     * Get the user that owns the article.
     */
    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    /**
     * Get the categories that belongs to the article.
     */
    public function categories(){
        return $this->belongsToMany(Category::class, 'article_category','article_id', 'category_id')
            ->withTimestamps();
    }

    /**
    *format the date for use in javascript
     **/
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d-m-Y');
    }


    /**
     * Truncate an article's body and append to json
     */
    public function getArticleBodyAttribute(){
        return Str::of($this->body)->limit(40);
    }

    /**
     * return all the categories
     */
    public function getAllCategoriesAttribute(){
        return Category::get();
    }

    protected $appends = ['formatted_date', 'article_body','all_categories'];
}
