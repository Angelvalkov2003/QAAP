<x-layout>
    @auth
    <form action="{{ route('tasks.search') }}" method="GET" class="flex items-center space-x-2">
        <input type="text" name="query" placeholder="Search tasks by label and description..." class="p-2 border border-gray-300 rounded">
        <button type="submit" class="py-1 px-3 bg-white hover:bg-red-500 hover:text-white border border-gray-300">Search</button>
    </form>
    
    
    
    
    
    @endauth
    <ul class="flex flex-col sm:flex-row space-y-2 sm:space-x-4 sm:space-y-0">
        @foreach ($regions as $region)
        <li class="w-full sm:w-auto">
            <a href="{{ route('tasks.region', $region->id) }}" class="block p-4 bg-white hover:bg-red-500 hover:text-white font-semibold text-center w-32 h-12 flex items-center justify-center transition-all">
                <h3>{{ $region->name }}</h3>
            </a>
        </li>
        @endforeach
    </ul>
    
    <ul>
        @if (isset($currentFolder))
        <li>
            <div class='card'>
                <h3>.. </h3>
                <a href="{{ $parentFolderId ? route('folders.show', $parentFolderId) : route('tasks.index') }}" class="btn">Go Back</a>
            </div>
        </li>
    @endif
    
        @foreach ($folders as $folder)
            <li>
                <div class='card'>
                    <h3>{{ $folder->name }}</h3>
                    <a href="{{ route('folders.show', $folder->id) }}" class="btn">View Details</a>
                </div>
            </li>
        @endforeach
    </ul>
    
    
    <ul>
        @foreach ($tasks as $task)
        <li>
            <x-card href="{{ route( 'tasks.show', $task->id ) }}" :EMEA="$task['region_id'] == 1" :AMS="$task['region_id'] == 2" :APAC="$task['region_id'] == 3" :Closed="$task['status_id'] == 5">
                <h3>{{ $task['label'] }}</h3>
            </x-card>
        </li>
        @endforeach
    </ul>


    {{ $tasks->links() }} <!-- pravi funkcioalnostta sys strinicite-->
</x-layout>