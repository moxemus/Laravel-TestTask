<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WorkerDepartmentSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('worker_department')->insert([
                'worker_id' => rand(1, 10),
                'department_id' => rand(1, 10)
            ]);
        }
    }
}
