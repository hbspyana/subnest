<h1>{{ $category->name }}</h1>

<p>{{ $category->description }}</p>

<a href="{{ route('categories.edit', $category) }}">
    Edit Category
</a>

<a href="{{ route('categories.index') }}">
    Back to Categories
</a>

<form action="{{ route('categories.destroy', $category) }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="submit"
        onclick="return confirm('Are you sure you want to delete this category?')">
        Delete Category
    </button>
</form>