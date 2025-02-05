<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks', [TaskController::class, 'index']);

Route::get('/tasks/create', [TaskController::class, 'create']);

Route::get('/tasks/{id}', [TaskController::class, 'show']);