<x-layout>
    <form action="{{ route('tasks.store') }}" method="POST">
        <!-- Token for CSRF protection -->
        @csrf

        <h2>Create a Task</h2>

        <label for="label">Task label:</label>
        <input 
            type="text" 
            id="label" 
            name="label" 
            value="{{ old('label') }}" 
            required
        >

        <label for="description">Description:</label>
        <textarea
            rows="15"
            id="description" 
            name="description" 
            required
        >{{ old('description') }}</textarea>

        <label for="region_id">Region:</label>
        <select id="region_id" name="region_id" required>
            <option value="" disabled selected>Select a region</option>
            @foreach ($regions as $region)
                <option value="{{ $region->id }}" {{ $region->id == old('region_id') ? 'selected' : '' }}>
                    {{ $region->name }}
                </option>
            @endforeach
        </select>

        <label for="status_id">Status:</label>
        <select id="status_id" name="status_id" required>
            <option value="" disabled selected>Select a status</option>
            @foreach ($statuses as $status)
                <option value="{{ $status->id }}" {{ $status->id == old('status_id') ? 'selected' : '' }}>
                    {{ $status->name }}
                </option>
            @endforeach
        </select>

        <label for="user_id">User:</label>
        <select id="user_id" name="user_id" required>
            <option value="" disabled selected>Select a user</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ $user->id == old('user_id') ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn mt-4">Create Task</button>

        @if ($errors->any())
            <ul class="px-4 py-2 bg-red-100">
                @foreach ($errors->all() as $error)
                    <li class="my-2 text-red-500">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </form>
</x-layout>
