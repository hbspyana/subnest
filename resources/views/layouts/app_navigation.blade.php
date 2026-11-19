<aside class="w-64 min-h-screen bg-slate-900 border-r border-slate-800 flex flex-col">

    <!-- Logo -->
    <div class="px-6 py-6 border-b border-slate-800">
        <a href="{{ route('dashboard') }}"
           class="text-2xl font-bold text-white">
            Subnest<span class="text-purple-500">.</span>
        </a>
        <p class="text-xs text-slate-400 mt-1">Subscription Manager</p>
    </div>

    <!-- Navigation Links -->
    <div class="px-4 py-6 flex-1">

        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3 px-3">
            Menu
        </p>

        <a href="{{ route('dashboard') }}"
           class="flex items-center px-3 py-3 rounded-lg mb-2
           {{ request()->routeIs('dashboard') ? 'bg-purple-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
            Dashboard
        </a>

        @if (Route::has('categories.index'))
            <a href="{{ route('categories.index') }}"
               class="flex items-center px-3 py-3 rounded-lg mb-2
               {{ request()->routeIs('categories.*') ? 'bg-purple-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                Categories
            </a>
        @endif

    </div>

    <!-- User Account -->
    <div class="border-t border-slate-800 p-4">

        <p class="text-sm font-semibold text-white">
            {{ Auth::user()->name }}
        </p>

        <p class="text-xs text-slate-400 mb-4">
            {{ Auth::user()->email }}
        </p>

        <a href="{{ route('profile.edit') }}"
           class="block text-sm text-slate-400 hover:text-white py-2">
            Profile
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                    class="text-sm text-red-400 hover:text-red-300 py-2">
                Log Out
            </button>
        </form>

    </div>

</aside>