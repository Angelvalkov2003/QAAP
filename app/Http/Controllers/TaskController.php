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
        ]);

        $validated['user_id'] = auth()->id();

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
            "region" => $region,
            "regions" => $regions
        ]);
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);

        if (auth()->id() !== $task->user_id) {
            abort(403, 'This action is unauthorized.');
        }

        $regions = Region::all();
        $statuses = Status::all();

        return view('tasks.edit', compact('task', 'regions', 'statuses'));
    }


    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        if (auth()->id() !== $task->user_id) {
            abort(403, 'This action is unauthorized.');
        }

        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'description' => 'required|string|min:20|max:1000',
            'region_id' => 'required|exists:regions,id',
            'status_id' => 'required|exists:statuses,id',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }


    public function search(Request $request)
    {
        $regions = Region::all();

        $request->validate([
            'query' => 'nullable|string|max:255',
        ]);

        $query = $request->input('query');

        $tasks = Task::when($query, function ($queryBuilder) use ($query) {
            $queryBuilder->where('label', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%");
        })
            ->orderBy('status_id')
            ->paginate(10);

        return view('tasks.index', ["tasks" => $tasks, "regions" => $regions]);
    }


}
