<x-app-layout>
    <div class="min-h-screen bg-slate-950 text-white py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-bold">Payment History</h1>
                    <p class="text-slate-400 mt-2">Track all your subscription payments.</p>
                </div>

                <a href="{{ route('subscriptions.index') }}"
                   class="px-5 py-3 rounded-xl bg-purple-600 hover:bg-purple-500 text-white font-semibold">
                    Back to Subscriptions
                </a>
            </div>

            @if (session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/30 text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            @if ($payments->isEmpty())
                <div class="bg-slate-900 border border-slate-800 rounded-2xl p-10 text-center">
                    <h2 class="text-xl font-semibold mb-2">No payments yet</h2>
                    <p class="text-slate-400 mb-6">Record your first subscription payment to see it here.</p>
                    <a href="{{ route('subscriptions.index') }}"
                       class="inline-block px-5 py-3 rounded-xl bg-purple-600 hover:bg-purple-500 font-semibold">
                        View Subscriptions
                    </a>
                </div>
            @else
                <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-slate-800/70 text-slate-400 text-sm">
                                <tr>
                                    <th class="px-6 py-4">Subscription</th>
                                    <th class="px-6 py-4">Amount</th>
                                    <th class="px-6 py-4">Payment Date</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-800">
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                @if ($payment->subscription->logo_url)
                                                    <img src="{{ $payment->subscription->logo_url }}"
                                                         alt=""
                                                         class="w-10 h-10 rounded-lg object-contain bg-white p-1">
                                                @else
                                                    <div class="w-10 h-10 rounded-lg bg-slate-800 flex items-center justify-center">
                                                        {{ strtoupper(substr($payment->subscription->name, 0, 1)) }}
                                                    </div>
                                                @endif

                                                <span class="font-medium">{{ $payment->subscription->name }}</span>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4">
                                            €{{ number_format($payment->amount, 2) }}
                                        </td>

                                        <td class="px-6 py-4 text-slate-300">
                                            {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}
                                        </td>

                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                                {{ $payment->status === 'paid'
                                                    ? 'bg-green-500/10 text-green-400'
                                                    : 'bg-yellow-500/10 text-yellow-400' }}">
                                                {{ ucfirst($payment->status) }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex flex-wrap items-center gap-3">
                                                <form method="POST" action="{{ route('payments.updateStatus', $payment) }}">
                                                    @csrf
                                                    @method('PATCH')

                                                    <input type="hidden" name="status"
                                                           value="{{ $payment->status === 'paid' ? 'pending' : 'paid' }}">

                                                    <button type="submit" class="text-purple-400 hover:text-purple-300 text-sm font-medium">
                                                        Mark as {{ $payment->status === 'paid' ? 'Pending' : 'Paid' }}
                                                    </button>
                                                </form>

                                                <form method="POST" action="{{ route('payments.destroy', $payment) }}"
                                                      onsubmit="return confirm('Are you sure you want to delete this payment?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="text-red-400 hover:text-red-300 text-sm font-medium">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
