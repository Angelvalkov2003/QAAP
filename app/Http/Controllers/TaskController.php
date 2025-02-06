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
        $regions = Region::all();
        $tasks = Task::orderBy('status_id', 'asc')->paginate(10);
        return view('tasks.index', ["tasks" => $tasks, "regions" => $regions]);
    }

    public function show($id)
    {
        $task = Task::with(['region', 'status', 'user'])->findOrFail($id);
        return view('tasks.show', ["task" => $task]);
    }

    public function create()
    {
        $tasks = Task::all();
        $regions = Region::all();
        $statuses = Status::all();
        $users = User::all();

        return view('tasks.create', ['tasks' => $tasks, 'regions' => $regions, 'statuses' => $statuses, 'users' => $users]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'description' => 'required|string|min:20|max:1000',
            'region_id' => 'required|exists:regions,id',
            'status_id' => 'required|exists:statuses,id',
            'user_id' => 'required|exists:users,id',
        ]);
        Task::create($validated);
        return redirect()->route('tasks.index')->with('success', 'Task Created!');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task Deleted');
    }

    public function region($id)
    {
        $region = Region::findOrFail($id);
        $regions = Region::all(); // Get all regions for the sidebar/menu
        $tasks = Task::where('region_id', $id)
            ->orderBy('status_id', 'asc')
            ->paginate(10);

        return view('tasks.index', [
            "tasks" => $tasks,
            "region" => $region, // Selected region
            "regions" => $regions // Ensure all regions are available in the view
        ]);
    }


}
