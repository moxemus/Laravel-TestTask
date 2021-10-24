<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerDepartmentTable extends Migration
{
    public function up()
    {
        Schema::create('worker_department', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('worker_id');
            $table->integer('department_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('worker_department');
    }
}
