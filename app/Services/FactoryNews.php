<?php

namespace App\Services;

use Faker\Provider\ru_RU\Text;
use Faker\Factory as Faker;

class FactoryNews
{
    public function getAllNews(int $countNews): array
    {
        $faker = Faker::create();
        $arrNews = [];
        for ($i = 0; $i < $countNews; $i++) {
            $arrNews[] = [
                'title' => $faker->text(50),
                'text' => $faker->text(200),
            ];
        }
        return $arrNews;
    }
}
