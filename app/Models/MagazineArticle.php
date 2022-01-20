<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MagazineArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image'
    ];

    /**
     * Get the user that owns the article.
     */
    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    /**
     * Get the magazine that owns the magazine article
     */
    public function magazine(){
        return $this->belongsTo(Magazine::class);
    }
}
