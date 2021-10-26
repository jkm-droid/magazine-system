<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MagazinesMagazineArticle extends Model
{
    use HasFactory;

    protected $table = "magazines_magazine_articles";

    protected $fillable = [
        'magazine_id',
        'magazine_article_id'
    ];

    /**
     * Get the magazines that owns the magazines_magazine_article.
     */
    public function magazines(){
        return $this->belongsToMany(Magazine::class);
    }

    /**
     * Get the magazine_articles that owns the magazines_magazine_articles.
     */
    public function magazine_articles(){
        return $this->belongsToMany(MagazineArticle::class);
    }
}
