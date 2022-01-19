<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Worker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkerDepartmentSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('worker_department')->insert([
                'worker_id' => Department::all()->random(1)->first()->id,
                'department_id' => Worker::all()->random(1)->first()->id
            ]);
        }
    }
}
