<x-layout>
    <h2>
        Tasks:
    </h2>

    <ul>
        @foreach ($tasks as $task)
        <li>
            <x-card href="/tasks/{{ $task['id'] }}" :region="$task['region'] == 'AMS'">
                <h3>{{ $task['label'] }}</h3>
            </x-card>
        </li>
        @endforeach
    </ul>
</x-layout>