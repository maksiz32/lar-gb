<?php

namespace App\Services;

use Faker\Provider\ru_RU\Text;
use Faker\Factory as Faker;

class FactoryNews
{
    const CATEGORIES = [
        1 => 'weather',
        2 => 'crime',
    ];

    public function getAllNews(int $countNews): array
    {
        $faker = Faker::create();
        $arrNews = [];
        for ($i = 0; $i < $countNews; $i++) {
            $category = ($i % 2 === 0) ? 1 : 2;

            $arrNews[] = [
                'id' => $i,
                'title' => $faker->text(50),
                'text' => $faker->text(200),
                'category' => $this::CATEGORIES[$category],
            ];
        }
        return $arrNews;
    }

    public function getCategories(): array
    {
        return $this::CATEGORIES;
    }
}
