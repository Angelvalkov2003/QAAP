<x-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Create a Task</h2>

        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Task Label -->
            <div>
                <label for="label" class="block text-sm font-medium text-gray-700">Task Label:</label>
                <input
                    type="text"
                    id="label"
                    name="label"
                    value="{{ old('label') }}"
                    required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                >
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                <textarea
                    id="description"
                    name="description"
                    rows="6"
                    required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                >{{ old('description') }}</textarea>
            </div>

            <!-- Region -->
            <div>
                <label for="region_id" class="block text-sm font-medium text-gray-700">Region:</label>
                <select
                    id="region_id"
                    name="region_id"
                    required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                >
                    <option value="" disabled selected>Select a region</option>
                    @foreach ($regions as $region)
                        <option value="{{ $region->id }}" {{ $region->id == old('region_id') ? 'selected' : '' }}>
                            {{ $region->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Status -->
            <div>
                <label for="status_id" class="block text-sm font-medium text-gray-700">Status:</label>
                <select
                    id="status_id"
                    name="status_id"
                    required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                >
                    <option value="" disabled selected>Select a status</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}" {{ $status->id == old('status_id') ? 'selected' : '' }}>
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Folder -->
            <div>
                <label for="parent_id" class="block text-sm font-medium text-gray-700">Folder:</label>
                <select
                    id="parent_id"
                    name="parent_id"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                >
                    <option value="" {{ old('parent_id') == '' ? 'selected' : '' }}>Root Folder</option>
                    @foreach ($folders as $folder)
                        <option value="{{ $folder->id }}" {{ $folder->id == old('parent_id') ? 'selected' : '' }}>
                            {{ $folder->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-3 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-200">
                Create Task
            </button>
        </form>

        <!-- Error Messages -->
        @if ($errors->any())
            <ul class="mt-6 px-4 py-2 bg-red-100 rounded-lg">
                @foreach ($errors->all() as $error)
                    <li class="my-2 text-red-500">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</x-layout>
