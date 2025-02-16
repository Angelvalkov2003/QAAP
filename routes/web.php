<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FolderController;

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
Route::middleware(['auth'])->group(function () {

    Route::get('/tasks/search', [TaskController::class, 'search'])->name('tasks.search');
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::get('/tasks/region/{id}', [TaskController::class, 'region'])->name('tasks.region');



    Route::get('/folders/create', [FolderController::class, 'create'])->name('folders.create');
    Route::post('/folders', [FolderController::class, 'store'])->name('folders.store');
    Route::get('/folders/{id}', [FolderController::class, 'show'])->name('folders.show');
    Route::get('/folders/{id}/edit', [FolderController::class, 'edit'])->name('folders.edit');
    Route::put('/folders/{id}', [FolderController::class, 'update'])->name('folders.update');
    Route::delete('/folders/{id}', [FolderController::class, 'destroy'])->name('folders.destroy');
});

