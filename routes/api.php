<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\DepartmentController;


Route::resource('worker', WorkerController::class);

Route::resource('department', DepartmentController::class);

