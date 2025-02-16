<x-layout>
    <h2>Task ID - {{ $task->id }}</h2>
    <p><strong>Label:</strong> {{ $task->label }}</p>
    <p><strong>Description:</strong> {{ $task->description }}</p>
    <p><strong>Region:</strong> {{ $task->region->name ?? 'Unknown' }}</p>
    <p><strong>Status:</strong> {{ $task->status->name ?? 'Unknown' }}</p>
    <p><strong>Assigned User:</strong> {{ $task->user->name ?? 'Unassigned' }}</p>
    <p><strong>Folder:</strong>
        @if ($task->parentFolder)
            {{ $task->parentFolder->name }}
        @else
            Root Folder
        @endif
    </p>

    @if (auth()->id() === $task->user_id)

        <a href="{{ route('tasks.edit', $task->id) }}" class="btn my-2">Edit Task</a>


        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="mt-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn my-4">Delete Task</button>
        </form>
    @endif
</x-layout>
