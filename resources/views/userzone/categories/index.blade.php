<h1>My Categories</h1>

<p>Welcome, {{ auth()->user()->name }}!</p>

<a href="{{ route('categories.create') }}">Add Category</a>

@forelse ($categories as $category)
    <div>
        <h2>{{ $category->name }}</h2>

        <p>{{ $category->description }}</p>

        <a href="{{ route('categories.show', $category) }}">
            View
        </a>

        <a href="{{ route('categories.edit', $category) }}">
            Edit
        </a>
    </div>
@empty
    <p>You haven't created any categories yet.</p>
@endforelse