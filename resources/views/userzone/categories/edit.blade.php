<h1>Edit Category</h1>

<form action="{{ route('categories.update', $category) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="name">Category Name</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $category->name) }}"
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
        >{{ old('description', $category->description) }}</textarea>

        @error('description')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <button type="submit">Save Changes</button>

    <a href="{{ route('categories.index') }}">Cancel</a>
</form>