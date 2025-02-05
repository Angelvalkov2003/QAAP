<x-layout>
    <h2>Task ID - {{ $task->id }}</h2>
    <p><strong>Label:</strong> {{ $task->label }}</p>
    <p><strong>Description:</strong> {{ $task->description }}</p>
    <p><strong>Region:</strong> {{ $task->region->name ?? 'Unknown' }}</p>
    <p><strong>Status:</strong> {{ $task->status->name ?? 'Unknown' }}</p>
    <p><strong>Assigned User:</strong> {{ $task->user->name ?? 'Unassigned' }}</p>
</x-layout>
