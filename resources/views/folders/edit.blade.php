<x-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Edit Folder</h2>


    <form action="{{ route('folders.update', $folder->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Folder Name:</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $folder->name) }}"
            required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
        >
        </div>

        <div>
            <label for="parent_id" class="block text-sm font-medium text-gray-700">Parent Folder:</label>
            <select
                name="parent_id"
                id="parent_id"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
            >
                <option value="">No Parent</option>
                @foreach($folders as $parentFolder)
                <option value="{{ $parentFolder->id }}" {{ old('parent_id', $folder->parent_id) == $parentFolder->id ? 'selected' : '' }}>
                    {{ $parentFolder->name }}
                </option>
            @endforeach
            </select>
        </div>

        <button type="submit" class="w-full py-3 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-200">
            Update Folder
        </button>
    </form>

    <form action="{{ route('folders.destroy', $folder->id) }}" method="POST" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="w-full py-3 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-300 transition duration-200">
            Delete Folder
        </button>
    </form>
    @if ($errors->any())
    <ul class="px-4 py-2 bg-red-100">
        @foreach ($errors->all() as $error)
            <li class="my-2 text-red-500">{{ $error }}</li>
        @endforeach
    </ul>
    @endif

</div>
</x-layout>
