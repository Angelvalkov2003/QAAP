<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Task;
use App\Models\Status;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;


class FolderController extends Controller
{
    public function create()
    {
        // Get folders of the logged-in user
        $folders = Folder::where('user_id', auth()->id())->get();

        // Return the folder creation form
        return view('folders.create', compact('folders'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:folders,id,user_id,' . auth()->id(),
        ]);

        // Assign the user_id to the folder being created
        $validated['user_id'] = auth()->id();

        // Create the new folder
        Folder::create($validated);

        // Redirect to tasks index with success message
        return redirect()->route('tasks.index')->with('success', 'Folder Created!');
    }

    public function show($id)
    {
        $regions = Region::all();

        $folder = Folder::findOrFail($id);

        $parentFolderId = $folder->parent_id;


        $folder = Folder::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $folders = Folder::where('parent_id', $id)
            ->where('user_id', auth()->id())
            ->get();

        $tasks = Task::where('parent_id', $id)
            ->where('user_id', auth()->id())
            ->orderBy('status_id', 'asc')
            ->paginate(10);

        return view('tasks.index', [
            "tasks" => $tasks,
            "regions" => $regions,
            "folders" => $folders,
            "currentFolder" => $folder,
            "parentFolderId" => $parentFolderId
        ]);
    }
}
