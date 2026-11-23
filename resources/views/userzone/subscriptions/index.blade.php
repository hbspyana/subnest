<x-app-layout>

    <div class="max-w-7xl mx-auto">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

            <div>
                <h1 class="text-3xl font-bold text-white">
                    My Subscriptions
                </h1>

                <p class="text-slate-400 mt-2">
                    Manage all your subscriptions in one place.
                </p>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('payments.index') }}"
                    class="inline-flex items-center justify-center px-5 py-3 rounded-lg bg-slate-800 text-white hover:bg-slate-700 transition">
                    Payment History
                </a>

                <a href="{{ route('reminders.index') }}"
                    class="inline-flex items-center justify-center px-5 py-3 rounded-lg bg-slate-800 text-white hover:bg-slate-700 transition">
                    Reminders
                </a>

                <a href="{{ route('subscriptions.create') }}"
                    class="inline-flex items-center justify-center px-5 py-3 rounded-lg bg-purple-600 text-white hover:bg-purple-500 transition">
                    + Add Subscription
                </a>
            </div>

        </div>

        @if (session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-500/10 border border-green-500/30 text-green-400">
                {{ session('success') }}
            </div>
        @endif

        @if ($subscriptions->isEmpty())

            <div class="bg-slate-900 border border-slate-800 rounded-xl p-12 text-center">

                <h2 class="text-xl font-semibold text-white">
                    No subscriptions yet
                </h2>

                <p class="text-slate-400 mt-2">
                    Add your first subscription to start tracking your expenses.
                </p>

                <a href="{{ route('subscriptions.create') }}"
                    class="inline-block mt-6 px-5 py-3 rounded-lg bg-purple-600 text-white hover:bg-purple-500">
                    Add your first subscription
                </a>

            </div>

        @else

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

                @foreach ($subscriptions as $subscription)

                    <div class="bg-slate-900 border border-slate-800 rounded-xl p-6 hover:border-purple-500/50 transition">

                        <div class="flex items-center gap-4 mb-5">

                            @if ($subscription->logo_url)

                                <img
                                    src="{{ $subscription->logo_url }}"
                                    alt="{{ $subscription->name }} logo"
                                    class="w-12 h-12 rounded-xl object-contain bg-white p-1"
                                >

                            @else

                                <div class="w-12 h-12 rounded-xl bg-purple-600/20 flex items-center justify-center text-purple-400 font-bold text-xl">
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

                        <div class="border-t border-slate-800 pt-4">

                            <p class="text-sm text-slate-400">
                                Next payment
                            </p>

                            <p class="text-white mt-1">
                                {{ \Carbon\Carbon::parse($subscription->next_payment_date)->format('d M Y') }}
                            </p>

                        </div>

                        <div class="mt-4">

                            <span class="inline-block px-3 py-1 rounded-full text-xs font-medium
                                {{ $subscription->status === 'active'
                                    ? 'bg-green-500/10 text-green-400'
                                    : ($subscription->status === 'paused'
                                        ? 'bg-yellow-500/10 text-yellow-400'
                                        : 'bg-slate-700 text-slate-300') }}">

                                {{ ucfirst($subscription->status) }}

                            </span>

                        </div>

                        <div class="mt-5 space-y-3">

                            <a href="{{ route('payments.create', $subscription) }}"
                                class="block w-full text-center px-4 py-2.5 rounded-lg bg-purple-600/10 text-purple-400 hover:bg-purple-600/20 border border-purple-500/20 transition">
                                + Record Payment
                            </a>

                            <a href="{{ route('reminders.create', $subscription) }}"
                                class="block w-full text-center px-4 py-2.5 rounded-lg bg-slate-800 text-slate-300 hover:bg-slate-700 border border-slate-700 transition">
                                + Add Reminder
                            </a>

                        </div>

                        <div class="flex gap-3 mt-4 pt-4 border-t border-slate-800">

                            <a href="{{ route('subscriptions.edit', $subscription) }}"
                                class="flex-1 text-center px-4 py-2 rounded-lg bg-slate-800 text-white hover:bg-slate-700">
                                Edit
                            </a>

                            <form method="POST"
                                action="{{ route('subscriptions.destroy', $subscription) }}"
                                class="flex-1"
                                onsubmit="return confirm('Are you sure you want to delete this subscription? Its payment records will also be deleted.')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="w-full px-4 py-2 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20">
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
