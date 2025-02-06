<x-layout>
    <h2>Task ID - {{ $task->id }}</h2>
    <p><strong>Label:</strong> {{ $task->label }}</p>
    <p><strong>Description:</strong> {{ $task->description }}</p>
    <p><strong>Region:</strong> {{ $task->region->name ?? 'Unknown' }}</p>
    <p><strong>Status:</strong> {{ $task->status->name ?? 'Unknown' }}</p>
    <p><strong>Assigned User:</strong> {{ $task->user->name ?? 'Unassigned' }}</p>

    <form action="{{ route('tasks.destroy', $task->id)}}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn my-4">Delete task</button>
    </form>
</x-layout>
