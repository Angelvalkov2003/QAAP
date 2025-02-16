<?php

namespace App\Http\Controllers;

use App\Models\Folder;
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
        $tasks = Task::where('user_id', auth()->id())
            ->whereNull('parent_id')
            ->orderBy('status_id', 'asc')
            ->paginate(10);


        $folders = Folder::where('user_id', auth()->id())
            ->whereNull('parent_id')
            ->get();

        return view('tasks.index', ["tasks" => $tasks, "regions" => $regions, "folders" => $folders]);
    }

    public function show($id)
    {
        $task = Task::with(['region', 'status', 'user', 'parentFolder'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('tasks.show', ["task" => $task]);
    }


    public function create()
    {
        $userId = auth()->id();

        $tasks = Task::where('user_id', $userId)->get();
        $regions = Region::all();

        $statuses = Status::all();
        $users = User::where('id', $userId)->get();
        $folders = Folder::where('user_id', $userId)->get();

        return view('tasks.create', compact('tasks', 'regions', 'statuses', 'users', 'folders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'description' => 'required|string|min:20|max:1000',
            'region_id' => 'required|exists:regions,id',
            'status_id' => 'required|exists:statuses,id',
            'parent_id' => 'nullable|exists:folders,id,user_id,' . auth()->id(),
        ]);


        $validated['user_id'] = auth()->id();


        Task::create($validated);


        return redirect()->route('tasks.index')->with('success', 'Task Created!');
    }


    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== auth()->id()) {
            return redirect()->route('tasks.index')->with('error', 'this task is not yours.');
        }

        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task Deleted');
    }

    public function region($id)
    {
        $region = Region::findOrFail($id);
        $regions = Region::all();
        $folders = Folder::where('user_id', auth()->id())
            ->whereNull('parent_id')
            ->get();

        $tasks = Task::where('region_id', $id)
            ->where('user_id', auth()->id())
            ->orderBy('status_id', 'asc')
            ->paginate(10);

        return view('tasks.index', [
            "tasks" => $tasks,
            "region" => $region,
            "regions" => $regions,
            "folders" => $folders
        ]);
    }


    public function edit($id)
    {

        $task = Task::findOrFail($id);


        if ($task->user_id !== auth()->id()) {
            return redirect()->route('tasks.index')->with('error', 'This task is not yours.');
        }


        $regions = Region::all();
        $statuses = Status::all();


        $folders = Folder::where('user_id', auth()->id())->get();


        return view('tasks.edit', compact('task', 'regions', 'statuses', 'folders'));
    }



    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== auth()->id()) {
            return redirect()->route('tasks.index')->with('error', 'this task is not yours.');
        }

        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'description' => 'required|string|min:20|max:1000',
            'region_id' => 'required|exists:regions,id',
            'status_id' => 'required|exists:statuses,id',
            'parent_id' => 'nullable|exists:folders,id,user_id,' . auth()->id(),
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

        $folders = Folder::where('user_id', auth()->id())
            ->whereNull('parent_id')
            ->get();

        $query = $request->input('query');

        $tasks = Task::where('user_id', auth()->id())
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where(function ($q) use ($query) {
                    $q->where('label', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                });
            })
            ->orderBy('status_id')
            ->paginate(10);

        return view('tasks.index', ["tasks" => $tasks, "regions" => $regions, "folders" => $folders]);
    }


}
