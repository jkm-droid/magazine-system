<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'issue',
        'image',
        'slug',
        'copy',
    ];

    /**
     * Get the user that owns the article.
     */
    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    /**
     * Get the magazine_articles that belongs to the magazine.
     */
    public function magazine_articles(){
        return $this->hasMany(MagazineArticle::class);
    }
}
