
<x-app-layout>

    <div class="max-w-3xl mx-auto">

        <!-- Page Heading -->
        <div class="mb-8">
            <a href="{{ route('categories.index') }}"
               class="text-purple-400 hover:text-purple-300 text-sm">
                ← Back to Categories
            </a>

            <h1 class="text-3xl font-bold text-white mt-4">
                Edit Category
            </h1>

            <p class="text-slate-400 mt-2">
                Update your category information.
            </p>
        </div>

        <!-- Form Card -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-8">

            <form action="{{ route('categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Category Name -->
                <div class="mb-6">
                    <label for="name"
                           class="block text-sm font-medium text-slate-300 mb-2">
                        Category Name
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $category->name) }}"
                        required
                        class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-purple-500"
                    >

                    @error('name')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-8">
                    <label for="description"
                           class="block text-sm font-medium text-slate-300 mb-2">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-purple-500"
                    >{{ old('description', $category->description) }}</textarea>

                    @error('description')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex items-center gap-4">

                    <button
                        type="submit"
                        class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg font-medium transition">
                        Save Changes
                    </button>

                    <a href="{{ route('categories.index') }}"
                       class="text-slate-400 hover:text-white transition">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>
