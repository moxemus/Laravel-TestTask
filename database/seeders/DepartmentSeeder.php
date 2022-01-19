<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $this->faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('department')->insert([
                'name' => $this->faker->text(10)
            ]);
        }
    }
}
