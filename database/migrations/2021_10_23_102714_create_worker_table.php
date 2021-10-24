<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerTable extends Migration
{
    public function up()
    {
        Schema::create('worker', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->string('surname');
            $table->string('patronymic');
            $table->smallInteger('gender');
            $table->decimal('salary',10,2);
        });
    }

    public function down()
    {
        Schema::dropIfExists('worker');
    }
}
