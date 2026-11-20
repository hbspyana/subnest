
<x-app-layout>

    <div class="max-w-7xl mx-auto">

        <!-- Page heading -->
        <div class="flex flex-col sm:flex-row sm:items-center
                    sm:justify-between gap-4 mb-8">

            <div>
                <h1 class="text-3xl font-bold text-white">
                    My Subscriptions
                </h1>

                <p class="text-slate-400 mt-2">
                    Manage all your subscriptions in one place.
                </p>
            </div>

            <a href="{{ route('subscriptions.create') }}"
                class="inline-flex items-center justify-center px-5 py-3
                       rounded-lg bg-purple-600 text-white
                       hover:bg-purple-500 transition">
                + Add Subscription
            </a>

        </div>

        <!-- Success message -->
        @if (session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-500/10
                        border border-green-500/30 text-green-400">
                {{ session('success') }}
            </div>
        @endif

        <!-- Subscription list -->
        @if ($subscriptions->isEmpty())

            <div class="bg-slate-900 border border-slate-800
                        rounded-xl p-12 text-center">

                <h2 class="text-xl font-semibold text-white">
                    No subscriptions yet
                </h2>

                <p class="text-slate-400 mt-2">
                    Add your first subscription to start tracking your expenses.
                </p>

                <a href="{{ route('subscriptions.create') }}"
                    class="inline-block mt-6 px-5 py-3 rounded-lg
                           bg-purple-600 text-white hover:bg-purple-500">
                    Add your first subscription
                </a>

            </div>

        @else

            <div class="grid grid-cols-1 md:grid-cols-2
                        xl:grid-cols-3 gap-5">

                @foreach ($subscriptions as $subscription)

                    <div class="bg-slate-900 border border-slate-800
                                rounded-xl p-6 hover:border-purple-500/50
                                transition">

                        <!-- Service name and logo -->
                        <div class="flex items-center gap-4 mb-5">

                            @if ($subscription->logo_url)

                                <img
                                    src="{{ $subscription->logo_url }}"
                                    alt="{{ $subscription->name }} logo"
                                    class="w-12 h-12 rounded-xl object-contain
                                           bg-white p-1"
                                >

                            @else

                                <div class="w-12 h-12 rounded-xl bg-purple-600/20
                                            flex items-center justify-center
                                            text-purple-400 font-bold text-xl">
                                    {{ strtoupper(substr($subscription->name, 0, 1)) }}
                                </div>

                            @endif

                            <div>
                                <h2 class="text-lg font-semibold text-white">
                                    {{ $subscription->name }}
                                </h2>

                                <p class="text-sm text-slate-400">
                                    {{ $subscription->category->name ?? 'Uncategorized' }}
                                </p>
                            </div>

                        </div>

                        <!-- Price -->
                        <div class="mb-5">

                            <p class="text-sm text-slate-400">
                                Subscription cost
                            </p>

                            <p class="text-2xl font-bold text-white mt-1">
                                €{{ number_format($subscription->price, 2) }}

                                <span class="text-sm font-normal text-slate-400">
                                    / {{ $subscription->billing_cycle }}
                                </span>
                            </p>

                        </div>

                        <!-- Next payment -->
                        <div class="border-t border-slate-800 pt-4">

                            <p class="text-sm text-slate-400">
                                Next payment
                            </p>

                            <p class="text-white mt-1">
                                {{ \Carbon\Carbon::parse($subscription->next_payment_date)->format('d M Y') }}
                            </p>

                        </div>

                        <!-- Status -->
                        <div class="mt-4">

                            <span class="inline-block px-3 py-1 rounded-full
                                text-xs font-medium
                                {{ $subscription->status === 'active'
                                    ? 'bg-green-500/10 text-green-400'
                                    : 'bg-slate-700 text-slate-300' }}">

                                {{ ucfirst($subscription->status) }}

                            </span>

                        </div>

                        <!-- Edit and Delete buttons -->
                        <div class="flex gap-3 mt-5 pt-4 border-t border-slate-800">

                            <a href="{{ route('subscriptions.edit', $subscription) }}"
                                class="flex-1 text-center px-4 py-2 rounded-lg
                                       bg-slate-800 text-white hover:bg-slate-700">
                                Edit
                            </a>

                            <form method="POST"
                                action="{{ route('subscriptions.destroy', $subscription) }}"
                                onsubmit="return confirm('Are you sure you want to delete this subscription?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="px-4 py-2 rounded-lg bg-red-500/10
                                           text-red-400 hover:bg-red-500/20">
                                    Delete
                                </button>

                            </form>

                        </div>

                    </div>

                @endforeach

            </div>

        @endif

    </div>

</x-app-layout>
