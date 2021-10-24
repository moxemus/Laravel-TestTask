<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentTable extends Migration
{
    public function up()
    {
        Schema::create('department', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('department');
    }
}
