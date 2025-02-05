<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks', function () {
    $tasks = [
        ["label" => "Amazon NPS", "region" => "EMEA", "status" => "QA initial", "id" => "1"],
        ["label" => "SRI USA", "region" => "AMS", "status" => "PM review", "id" => "2"],
        ["label" => "Disney", "region" => "EMEA", "status" => "Estiamte", "id" => "3"]
    ];
    return view('tasks.index', ["tasks" => $tasks]);
});

Route::get('/tasks/create', function () {

    return view('tasks.create');
});

Route::get('/tasks/{id}', function ($id) {

    return view('tasks.show', ["id" => $id]);
});