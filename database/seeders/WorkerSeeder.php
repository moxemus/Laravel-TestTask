<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkerSeeder extends Seeder
{
    public function run()
    {
        $this->faker = Faker::create();

        $gender = rand(0, 1);
        $name = ($gender == 1) ? $this->faker->firstNameMale : $this->faker->firstNameFemale;

        for ($i = 0; $i < 10; $i++) {
            DB::table('worker')->insert([
                'name' => $name,
                'surname' => $this->faker->lastName,
                'patronymic' => $this->faker->firstNameMale,
                'gender' => $gender,
                'salary' => rand(1 * 10, 10000 * 10) / 10
            ]);
        }
    }
}
