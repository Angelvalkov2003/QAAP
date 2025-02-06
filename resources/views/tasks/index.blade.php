<x-layout>
    <ul>
        @foreach ($regions as $region)
        <li>
            <a href="{{ route('tasks.region', $region->id) }}" class="">
                <h3>{{ $region->name }}</h3>
            </a>
        </li>
        @endforeach
    </ul>
    
    <a href="/tasks" class="btn">All tasks</a>
    <h2>
        Tasks:
    </h2>

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