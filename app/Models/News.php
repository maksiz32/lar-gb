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

    public static function getCountNews(int $countNews): array
    {
        return (new FactoryNews())->getAllNews($countNews);
    }

    public static function getAllCategories(): array
    {
        return (new FactoryNews())->getCategories();
    }

    public static function getNewsByCategory(string $nameCategory): array
    {
        $result = [];
        $arrNews = self::getCountNews(20);

        $result = array_filter($arrNews, function($i) use ($nameCategory) {
            if ($i['category'] === $nameCategory) {
                return $i;
            }
        });
        $result = array_values($result);
        return $result;
    }

    public static function oneNews(int $id): array
    {
        $arrNews = self::getCountNews(20);

        $result = array_filter($arrNews, function($i) use ($id) {
            if ($i['id'] === $id) {
                return $i;
            }
        });
        $result = array_values($result);

        return $result;
    }
}
