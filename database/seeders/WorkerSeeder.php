<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WorkerSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('worker')->insert([
                'name' => Str::random(10),
                'surname' => Str::random(10),
                'patronymic' => Str::random(10),
                'gender' => rand(0, 1),
                'salary' => rand(1 * 10, 10000 * 10) / 10
            ]);
        }
    }
}
