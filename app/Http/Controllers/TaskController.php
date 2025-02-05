<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Status;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('status_id', 'asc')->get();
        return view('tasks.index', ["tasks" => $tasks]);
    }

    public function show($id)
    {
        $task = Task::with(['region', 'status', 'user'])->findOrFail($id); // Зарежда релациите
        return view('tasks.show', ["task" => $task]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function edit($id)
    {
        // Логика за редактиране на задача
    }
}