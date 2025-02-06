<x-layout>

    @auth
        <form action="{{ route('tasks.search') }}" method="GET">
            @csrf
            <input type="text" name="query" placeholder="Search tasks..." value="{{ request()->query('query') }}" required>
            <button type="submit">Search</button>
        </form>
    @endauth

    <ul>
        @foreach ($regions as $region)
        <li>
            <a href="{{ route('tasks.region', $region->id) }}" class="">
                <h3>{{ $region->name }}</h3>
            </a>
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