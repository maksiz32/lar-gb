<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert($this->newData(7));
    }

    private function newData(int $count)
    {
        $faker = \Faker\Factory::create('ru_RU');
        $data = [];
        for ($i = 0; $i <= $count; $i++) {
            $data[] = [
                'category' => $faker->word,
                'created_at' => $faker->date('Y-m-d H:i:s'),
                'updated_at' => $faker->date('Y-m-d H:i:s'),
            ];
        }
        return $data;
    }
}
