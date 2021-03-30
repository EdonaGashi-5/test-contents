<?php

namespace App\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        //attraverso il campo author_id ritorna uno user
        return $this->belongsTo(User::class, 'author_id');
    }
    public function getIsPublishedAttribute() {

        if ($this->status == Config::get('constants.ARTICLE_STATUS_PUBLISHED')){
            return true;
        };
        return false;
    }
}
