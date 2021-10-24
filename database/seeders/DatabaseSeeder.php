<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(DepartmentSeeder::class);
        $this->call(WorkerSeeder::class);
        $this->call(WorkerDepartmentSeeder::class);
    }
}
