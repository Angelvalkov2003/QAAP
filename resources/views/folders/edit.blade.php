<x-layout>
    <h2>Edit Folder</h2>

    <form action="{{ route('folders.update', $folder->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Folder Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $folder->name) }}" required>

        <label for="parent_id">Parent Folder:</label>
        <select name="parent_id" id="parent_id">
            <option value="">No Parent</option>
            @foreach($folders as $parentFolder)
                <option value="{{ $parentFolder->id }}" {{ old('parent_id', $folder->parent_id) == $parentFolder->id ? 'selected' : '' }}>
                    {{ $parentFolder->name }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn mt-4">Update Folder</button>
    </form>

    <form action="{{ route('folders.destroy', $folder->id) }}" method="POST" class="mt-2">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn my-4">Delete Folder</button>
    </form>

    @if ($errors->any())
    <ul class="px-4 py-2 bg-red-100">
        @foreach ($errors->all() as $error)
            <li class="my-2 text-red-500">{{ $error }}</li>
        @endforeach
    </ul>
    @endif
</x-layout>
