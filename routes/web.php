<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['guest'])->controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('show.register');
    Route::get('/login', 'showLogin')->name('show.login');
    Route::post('/register', 'Register')->name('register');
    Route::post('/login', 'Login')->name('login');
});

Route::post('/logout', [AuthController::class, 'Logout'])->name('logout');

// pravi middleware koyto proverqva dali sa auth na vsichki path v nego i dobavq che polzvame TaskController za vsichki
Route::middleware(['auth'])->controller(TaskController::class)->group(function () {
    Route::get('/tasks', 'index')->name('tasks.index');
    Route::get('/tasks/create', 'create')->name('tasks.create');
    Route::get('/tasks/{id}', 'show')->name('tasks.show');
    Route::post('/tasks', 'store')->name('tasks.store');

    Route::get('/tasks/{id}/edit', 'edit')->name('tasks.edit');
    Route::put('/tasks/{id}', 'update')->name('tasks.update');

    Route::delete('/tasks/{id}', 'destroy')->name('tasks.destroy');

    Route::get('/tasks/region/{id}', 'region')->name('tasks.region');

    Route::get('/tasks/search', 'search')->name('tasks.search');
});
