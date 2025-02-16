
<x-layout>
    <form action="{{ route('folders.store') }}" method="POST">
        @csrf

        <h2>Create a New Folder</h2>

        <label for="name">Folder Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>

        <label for="parent_id">Parent Folder:</label>
        <select name="parent_id" id="parent_id">
            <option value="">No Parent</option>
            @foreach($folders as $folder)
                <option value="{{ $folder->id }}">{{ $folder->name }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn mt-4">Create Folder</button>

        @if ($errors->any())
            <ul class="px-4 py-2 bg-red-100">
                @foreach ($errors->all() as $error)
                    <li class="my-2 text-red-500">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </form>
</x-layout>
