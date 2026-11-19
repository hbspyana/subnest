<h1>Create a Category</h1>

<form action="{{ route('categories.store') }}" method="POST">
    @csrf

    <div>
        <label for="name">Category Name</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name') }}"
            required
        >

        @error('name')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description">Description</label>
        <textarea
            id="description"
            name="description"
        >{{ old('description') }}</textarea>

        @error('description')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">Create Category</button>

    <a href="{{ route('categories.index') }}">Cancel</a>
</form>