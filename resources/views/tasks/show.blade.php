<x-layout>
    <div class="max-w-3xl mx-auto p-8 bg-white shadow-xl rounded-xl border border-gray-200 transition-shadow duration-300">
        <h2 class="text-4xl font-semibold text-gray-900 mb-6">Task ID - {{ $task->id }}</h2>
        
        <div class="space-y-6 text-gray-700">
            <div class="flex items-center space-x-2 border-b border-gray-300 py-2">
                <span class="text-blue-600 font-medium">Label:</span>
                <p class="text-gray-800">{{ $task->label }}</p>
            </div>

            <div class="flex items-center space-x-2 border-b border-gray-300 py-2">
                <span class="text-blue-600 font-medium">Description:</span>
                <p class="text-gray-800">{{ $task->description }}</p>
            </div>

            <div class="flex items-center space-x-2 border-b border-gray-300 py-2">
                <span class="text-blue-600 font-medium">Region:</span>
                <p class="text-gray-800">{{ $task->region->name ?? 'Unknown' }}</p>
            </div>

            <div class="flex items-center space-x-2 border-b border-gray-300 py-2">
                <span class="text-blue-600 font-medium">Status:</span>
                <p class="text-gray-800">{{ $task->status->name ?? 'Unknown' }}</p>
            </div>

            <div class="flex items-center space-x-2 border-b border-gray-300 py-2">
                <span class="text-blue-600 font-medium">Assigned User:</span>
                <p class="text-gray-800">{{ $task->user->name ?? 'Unassigned' }}</p>
            </div>

            <div class="flex items-center space-x-2 border-b border-gray-300 py-2">
                <span class="text-blue-600 font-medium">Folder:</span>
                <p class="text-gray-800">
                    @if ($task->parentFolder)
                        {{ $task->parentFolder->name }}
                    @else
                        Root Folder
                    @endif
                </p>
            </div>
        </div>

        @if (auth()->id() === $task->user_id)
            <div class="mt-8 space-y-4">
                <a href="{{ route('tasks.edit', $task->id) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-semibold rounded-lg px-6 py-3 transition duration-200 transform shadow-md hover:shadow-xl">
                    <i class="fas fa-edit mr-2"></i> Edit Task
                </a>

                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-block bg-red-500 hover:bg-red-700 text-white font-semibold rounded-lg px-6 py-3 transition duration-200 transform shadow-md hover:shadow-xl">
                        <i class="fas fa-trash mr-2"></i> Delete Task
                    </button>
                </form>
            </div>
        @endif
    </div>
</x-layout>
