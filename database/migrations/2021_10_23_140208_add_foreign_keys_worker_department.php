<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysWorkerDepartment extends Migration
{
    public function up()
    {
        Schema::table('worker_department', function (Blueprint $table) {
           $table->bigInteger('worker_id')->unsigned()->change();
           $table->bigInteger('department_id')->unsigned()->change();

           $table->foreign('worker_id')->references('id')->on('worker')->onDelete('no action');
           $table->foreign('department_id')->references('id')->on('department')->onDelete('no action');
        });
    }
}
