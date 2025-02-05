<x-layout>
    <h2>
        Tasks:
    </h2>

    <ul>
        @foreach ($tasks as $task)
        <li>
            <x-card href="/tasks/{{ $task['id'] }}" :region="$task['region_id'] == 2">
                <h3>{{ $task['label'] }}</h3>
            </x-card>
        </li>
        @endforeach
    </ul>
</x-layout>