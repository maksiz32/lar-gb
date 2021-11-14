<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert($this->newData(20));
    }

    private function newData(int $count)
    {
        $faker = \Faker\Factory::create('ru_RU');
        $data = [];
        for ($i = 0; $i <= $count; $i++) {
            $data[] = [
                'title' => $faker->text(50),
                'text' => $faker->text(200),
                'author' => $faker->firstName . ' ' . $faker->lastName,
                'category_id' => random_int(0, 7),
                'source_id' => random_int(0, 7),
                'created_at' => $faker->date('Y-m-d H:i:s'),
                'updated_at' => $faker->date('Y-m-d H:i:s'),
            ];
        }
        return $data;
    }
}
