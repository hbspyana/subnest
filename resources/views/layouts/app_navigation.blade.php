<aside class="w-64 min-h-screen bg-slate-900 border-r border-slate-800 flex flex-col">

    <div class="px-6 py-6 border-b border-slate-800">
        <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-purple-400">
            Subnest
        </a>
        <p class="text-xs text-slate-500 mt-1">Subscription Manager</p>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-2">

        <a href="{{ route('dashboard') }}"
           class="block px-4 py-3 rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-purple-600/20 text-purple-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            Dashboard
        </a>

        <a href="{{ route('categories.index') }}"
           class="block px-4 py-3 rounded-lg transition {{ request()->routeIs('categories.*') ? 'bg-purple-600/20 text-purple-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            Categories
        </a>

        <a href="{{ route('subscriptions.index') }}"
           class="block px-4 py-3 rounded-lg transition {{ request()->routeIs('subscriptions.*') ? 'bg-purple-600/20 text-purple-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            Subscriptions
        </a>

        <a href="{{ route('payments.index') }}"
           class="block px-4 py-3 rounded-lg transition {{ request()->routeIs('payments.*') ? 'bg-purple-600/20 text-purple-400' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            Payment History
        </a>

    </nav>

    <div class="px-4 py-5 border-t border-slate-800">

        <div class="px-4 mb-4">
            <p class="text-white font-medium">{{ Auth::user()->name }}</p>
            <p class="text-slate-400 text-sm truncate">{{ Auth::user()->email }}</p>
        </div>

        <a href="{{ route('profile.edit') }}"
           class="block px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
            Profile
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                    class="w-full text-left px-4 py-3 rounded-lg text-red-400 hover:bg-red-500/10 transition">
                Log Out
            </button>
        </form>

    </div>

</aside>
