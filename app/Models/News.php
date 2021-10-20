<?php

namespace App\Models;

use App\Http\Controllers\News\NewsController;
use App\Services\FactoryNews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'text', 'author'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public static function getNewsByCategory(int $id)
    {
        /** @var Category $cat */
        $cat = Category::query()->find($id);
        $result = $cat->news()->get();

        return [
            'news' => $result,
            'catName' => $cat->category,
            ];
    }

    public static function oneNews(int $id)
    {
        $result = self::query()->find($id);

        return $result;
    }
}
