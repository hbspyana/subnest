
<x-app-layout>

    <div class="max-w-3xl mx-auto">

        <!-- Page Heading -->
        <div class="mb-8">
            <a href="{{ route('categories.index') }}"
               class="text-purple-400 hover:text-purple-300 text-sm">
                ← Back to Categories
            </a>

            <h1 class="text-3xl font-bold text-white mt-4">
                Category Details
            </h1>

            <p class="text-slate-400 mt-2">
                View information about this category.
            </p>
        </div>

        <!-- Category Card -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-8">

            <!-- Category Name -->
            <div class="mb-6">
                <p class="text-sm text-slate-400 mb-2">
                    Category Name
                </p>

                <h2 class="text-2xl font-bold text-white">
                    {{ $category->name }}
                </h2>
            </div>

            <!-- Description -->
            <div class="mb-8">
                <p class="text-sm text-slate-400 mb-2">
                    Description
                </p>

                <p class="text-slate-200">
                    {{ $category->description ?? 'No description provided.' }}
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-4 border-t border-slate-800 pt-6">

                <a href="{{ route('categories.edit', $category) }}"
                   class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg font-medium transition">
                    Edit Category
                </a>

                <form action="{{ route('categories.destroy', $category) }}"
                      method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this category?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium transition">
                        Delete Category
                    </button>
                </form>

            </div>

        </div>

    </div>

</x-app-layout>
