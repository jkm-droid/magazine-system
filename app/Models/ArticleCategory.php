<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasFactory;

    protected $table = "article_category";

    protected $fillable = [
        'article_id',
        'category_id'
    ];

    /**
     * Get the articles that owns the article_category.
     */
    public function articles(){
        return $this->belongsToMany(Article::class);
    }

    /**
     * Get the categories that owns the article_category.
     */
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
