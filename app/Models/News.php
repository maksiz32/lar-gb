<?php

namespace App\Models;

use App\Services\FactoryNews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    public static function getCountNews(
        int $countNews
    ): array
    {
        return (new FactoryNews())->getAllNews($countNews);
    }
}
