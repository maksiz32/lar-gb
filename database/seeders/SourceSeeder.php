<?php

namespace Database\Seeders;

use App\Models\Source;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sources')->insert($this->newData(10));
    }

    private function newData(int $count)
    {
        $faker = \Faker\Factory::create('ru_RU');
        $data = [];
        for ($i = 0; $i <= $count; $i++) {
            $data[] = [
                'name' => $faker->company,
                'path' => $faker->domainName,
                'created_at' => $faker->date('Y-m-d H:i:s'),
                'updated_at' => $faker->date('Y-m-d H:i:s'),
            ];
        }
        return $data;
    }
}
