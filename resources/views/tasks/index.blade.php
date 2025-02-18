<x-layout>
    @auth


    <form action="{{ route('tasks.search') }}" method="GET" class="max-w-lg mx-auto flex items-center gap-2">
        <div class="relative flex-grow">
            <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" name="query" placeholder="Search tasks by label and description..."
                class="w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                required />
        </div>
        <button type="submit" class="px-4 py-2 text-white bg-blue-500 hover:bg-blue-700 rounded-lg text-sm">
            Search
        </button>
    </form>

    @endauth


    <ul class="flex flex-wrap justify-center gap-3 mt-4">
        @foreach ($regions as $region)
        <li>
            <a href="{{ route('tasks.region', $region->id) }}" 
                class="block w-40 font-semibold text-center px-6 py-3 rounded-lg transition-all bg-white border border-gray-300
                    @if($region->id == 1) hover:bg-red-500 hover:text-white 
                    @elseif($region->id == 2) hover:bg-blue-500 hover:text-white 
                    @elseif($region->id == 3) hover:bg-yellow-500 hover:text-black 
                    @else hover:bg-gray-400 hover:text-white 
                    @endif">
                {{ $region->name }}
            </a>
        </li>
        @endforeach
    </ul>
    
    


    <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
        @if (isset($currentFolder))
        <li>
            <div class="p-4 bg-white border rounded-lg shadow flex justify-center items-center" style="height: 180px;">
                <a href="{{ $parentFolderId ? route('folders.show', $parentFolderId) : route('tasks.index') }}" 
                   class="block mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 text-center w-full">
                    Go Back
                </a>
            </div>
        </li>
        @endif

        @foreach ($folders as $folder)
        <li>
            <div class="p-4 bg-white border rounded-lg shadow">
                <h3 class="font-semibold text-lg">{{ $folder->name }}</h3>
                <div class="mt-2 space-y-2">
                    <a href="{{ route('folders.edit', $folder->id) }}" class="block px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-center">
                        Edit Folder
                    </a>
                    <a href="{{ route('folders.show', $folder->id) }}" class="block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 text-center">
                        View Details
                    </a>
                </div>
            </div>
        </li>
        @endforeach
    </ul>

    <!-- Tasks List -->
    <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
        @foreach ($tasks as $task)
        <li>
            <x-card href="{{ route('tasks.show', $task->id ) }}" 
                :EMEA="$task['region_id'] == 1" 
                :AMS="$task['region_id'] == 2" 
                :APAC="$task['region_id'] == 3" 
                :Closed="$task['status_id'] == 5">
                <h3 class="font-semibold">{{ $task['label'] }}</h3>
            </x-card>
        </li>
        @endforeach
    </ul>


    <div class="mt-6">
        {{ $tasks->links() }}
    </div>
</x-layout>
