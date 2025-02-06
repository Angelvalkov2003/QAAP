<x-layout>
    <h2>Edit Task ID - {{ $task->id }}</h2>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT') 

        <label for="label">Task Label:</label>
        <input
            type="text"
            id="label"
            name="label"
            value="{{ old('label', $task->label) }}"
            required
        >

        <label for="description">Description:</label>
        <textarea
            id="description"
            name="description"
            rows="10"
            required
        >{{ old('description', $task->description) }}</textarea>

        <label for="region_id">Region:</label>
        <select id="region_id" name="region_id" required>
            @foreach ($regions as $region)
                <option value="{{ $region->id }}" {{ old('region_id', $task->region_id) == $region->id ? 'selected' : '' }}>
                    {{ $region->name }}
                </option>
            @endforeach
        </select>

        <label for="status_id">Status:</label>
        <select id="status_id" name="status_id" required>
            @foreach ($statuses as $status)
                <option value="{{ $status->id }}" {{ old('status_id', $task->status_id) == $status->id ? 'selected' : '' }}>
                    {{ $status->name }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn mt-4">Update Task</button>
    </form>

    @if ($errors->any())
        <ul class="px-4 py-2 bg-red-100">
            @foreach ($errors->all() as $error)
                <li class="my-2 text-red-500">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</x-layout>
