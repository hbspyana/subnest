
<x-app-layout>

    <div class="max-w-6xl mx-auto">

        <!-- Page Heading -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-white">
                    My Categories
                </h1>
                <p class="text-slate-400 mt-2">
                    Welcome back, {{ auth()->user()->name }}!
                </p>
            </div>

            <a href="{{ route('categories.create') }}"
               class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-3 rounded-lg font-medium transition">
                + Add Category
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-900/40 border border-green-700 text-green-300 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Categories -->
        @forelse ($categories as $category)

            <div class="bg-slate-900 border border-slate-800 rounded-xl p-6 mb-4 flex justify-between items-center">

                <div>
                    <h2 class="text-xl font-semibold text-white">
                        {{ $category->name }}
                    </h2>

                    <p class="text-slate-400 mt-2">
                        {{ $category->description ?? 'No description provided.' }}
                    </p>
                </div>

                <div class="flex gap-4">
                    <a href="{{ route('categories.show', $category) }}"
                       class="text-purple-400 hover:text-purple-300">
                        View
                    </a>

                    <a href="{{ route('categories.edit', $category) }}"
                       class="text-blue-400 hover:text-blue-300">
                        Edit
                    </a>
                </div>

            </div>

        @empty

            <div class="bg-slate-900 border border-slate-800 rounded-xl p-10 text-center">
                <h2 class="text-xl font-semibold text-white mb-2">
                    No categories yet
                </h2>

                <p class="text-slate-400 mb-5">
                    Create your first category to organize your subscriptions.
                </p>

                <a href="{{ route('categories.create') }}"
                   class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-3 rounded-lg">
                    Create Category
                </a>
            </div>

        @endforelse

    </div>

</x-app-layout>
