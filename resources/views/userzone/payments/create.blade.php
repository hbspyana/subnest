
<x-app-layout>
    <div class="min-h-screen bg-slate-950 text-white py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <a href="{{ route('subscriptions.index') }}"
                   class="text-purple-400 hover:text-purple-300 text-sm">
                    ← Back to Subscriptions
                </a>

                <h1 class="text-3xl font-bold mt-4">Record Payment</h1>
                <p class="text-slate-400 mt-2">
                    Add a payment for {{ $subscription->name }}.
                </p>
            </div>

            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 sm:p-8">

                <div class="flex items-center gap-4 mb-8">
                    @if ($subscription->logo_url)
                        <img src="{{ $subscription->logo_url }}"
                             alt=""
                             class="w-14 h-14 rounded-xl object-contain bg-white p-2">
                    @else
                        <div class="w-14 h-14 rounded-xl bg-slate-800 flex items-center justify-center text-xl font-bold">
                            {{ strtoupper(substr($subscription->name, 0, 1)) }}
                        </div>
                    @endif

                    <div>
                        <h2 class="text-lg font-semibold">{{ $subscription->name }}</h2>
                        <p class="text-slate-400 text-sm">
                            Regular price: €{{ number_format($subscription->price, 2) }}
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('payments.store', $subscription) }}">
                    @csrf

                    <div class="space-y-6">

                        <div>
                            <label for="amount" class="block text-sm font-medium text-slate-300 mb-2">
                                Payment Amount (€)
                            </label>

                            <input
                                type="number"
                                name="amount"
                                id="amount"
                                step="0.01"
                                min="0"
                                value="{{ old('amount', $subscription->price) }}"
                                required
                                class="w-full rounded-xl bg-slate-800 border border-slate-700 text-white focus:border-purple-500 focus:ring-purple-500"
                            >

                            @error('amount')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="payment_date" class="block text-sm font-medium text-slate-300 mb-2">
                                Payment Date
                            </label>

                            <input
                                type="date"
                                name="payment_date"
                                id="payment_date"
                                value="{{ old('payment_date', now()->toDateString()) }}"
                                required
                                class="w-full rounded-xl bg-slate-800 border border-slate-700 text-white focus:border-purple-500 focus:ring-purple-500"
                            >

                            @error('payment_date')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-slate-300 mb-2">
                                Payment Status
                            </label>

                            <select
                                name="status"
                                id="status"
                                required
                                class="w-full rounded-xl bg-slate-800 border border-slate-700 text-white focus:border-purple-500 focus:ring-purple-500"
                            >
                                <option value="paid" {{ old('status', 'paid') === 'paid' ? 'selected' : '' }}>
                                    Paid
                                </option>
                                <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>
                                    Pending
                                </option>
                            </select>

                            @error('status')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 mt-8">
                        <button
                            type="submit"
                            class="px-6 py-3 rounded-xl bg-purple-600 hover:bg-purple-500 font-semibold"
                        >
                            Save Payment
                        </button>

                        <a
                            href="{{ route('subscriptions.index') }}"
                            class="px-6 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-center font-semibold"
                        >
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
