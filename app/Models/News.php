<?php

namespace App\Models;

use App\Http\Controllers\News\NewsController;
use App\Services\FactoryNews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'text', 'author', 'category_id', 'source_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function source()
    {
        return $this->belongsTo(Source::class);
    }
}
