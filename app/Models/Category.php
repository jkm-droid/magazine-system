<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author'
    ];

    /**
     * Get the user that owns the category.
     */
    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    /**
     * Get the article that belong to the category.
     */
    public function articles(){
        return $this->belongsToMany(Article::class,'article_category','category_id','article_id', )
            ->withTimestamps();
    }

    //format the date for use in javascript
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d-m-Y');
    }

    protected $appends = ['formatted_date'];
}
