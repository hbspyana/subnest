<x-app-layout>

    <div class="max-w-7xl mx-auto space-y-8">

        <!-- Dashboard heading -->
        <div>
            <h1 class="text-3xl font-bold text-white">
                Dashboard
            </h1>

            <p class="text-slate-400 mt-2">
                Welcome back, {{ auth()->user()->name }}!
                Here's an overview of your subscriptions.
            </p>
        </div>

        <!-- Statistics cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">

            <!-- Active subscriptions -->
            <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
                <p class="text-sm text-slate-400">
                    Active subscriptions
                </p>

                <h2 class="text-3xl font-bold text-white mt-3">
                    {{ $activeCount }}
                </h2>

                <p class="text-sm text-slate-500 mt-2">
                    Currently active services
                </p>
            </div>

            <!-- Monthly spending -->
            <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
                <p class="text-sm text-slate-400">
                    Monthly spending
                </p>

                <h2 class="text-3xl font-bold text-purple-400 mt-3">
                    €{{ number_format($monthlyTotal, 2) }}
                </h2>

                <p class="text-sm text-slate-500 mt-2">
                    Estimated monthly cost
                </p>
            </div>

            <!-- Yearly spending -->
            <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
                <p class="text-sm text-slate-400">
                    Yearly spending
                </p>

                <h2 class="text-3xl font-bold text-white mt-3">
                    €{{ number_format($yearlyTotal, 2) }}
                </h2>

                <p class="text-sm text-slate-500 mt-2">
                    Estimated annual cost
                </p>
            </div>

        </div>

        <!-- Spending by category -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">

            <div class="mb-6">
                <h2 class="text-xl font-semibold text-white">
                    Spending by category
                </h2>

                <p class="text-sm text-slate-400 mt-1">
                    Your estimated monthly spending across categories.
                </p>
            </div>

            @if ($categorySpending->isEmpty())

                <p class="text-slate-400 text-center py-8">
                    Add subscriptions to see your spending breakdown.
                </p>

            @else

                <div class="space-y-6">

                    @foreach ($categorySpending as $category => $amount)

                        @php
                            $percentage = $monthlyTotal > 0
                                ? ($amount / $monthlyTotal) * 100
                                : 0;
                        @endphp

                        <div>

                            <div class="flex justify-between items-center mb-2">

                                <span class="text-white font-medium">
                                    {{ $category }}
                                </span>

                                <span class="text-slate-300 text-sm">
                                    €{{ number_format($amount, 2) }}
                                    ({{ number_format($percentage, 1) }}%)
                                </span>

                            </div>

                            <div class="w-full bg-slate-800 rounded-full h-3">

                                <div
                                    class="bg-purple-500 h-3 rounded-full transition-all"
                                    style="width: {{ $percentage }}%"
                                ></div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @endif

        </div>

        <!-- Upcoming payments -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">

                <div>
                    <h2 class="text-xl font-semibold text-white">
                        Upcoming payments
                    </h2>

                    <p class="text-sm text-slate-400 mt-1">
                        Payments due within the next 30 days.
                    </p>
                </div>

                <a
                    href="{{ route('subscriptions.index') }}"
                    class="text-sm text-purple-400 hover:text-purple-300"
                >
                    View all subscriptions →
                </a>

            </div>

            @if ($upcomingPayments->isEmpty())

                <div class="text-center py-8">
                    <p class="text-slate-400">
                        No upcoming payments in the next 30 days.
                    </p>
                </div>

            @else

                <div class="space-y-4">

                    @foreach ($upcomingPayments as $subscription)

                        <div class="flex items-center justify-between gap-4 border-b border-slate-800 pb-4 last:border-0">

                            <div class="flex items-center gap-3">

                                @if ($subscription->logo_url)

                                    <img
                                        src="{{ $subscription->logo_url }}"
                                        alt="{{ $subscription->name }} logo"
                                        class="w-10 h-10 rounded-lg bg-white p-1 object-contain"
                                    >

                                @else

                                    <div class="w-10 h-10 rounded-lg bg-purple-600/20 flex items-center justify-center text-purple-400 font-bold">
                                        {{ strtoupper(substr($subscription->name, 0, 1)) }}
                                    </div>

                                @endif

                                <div>
                                    <p class="font-medium text-white">
                                        {{ $subscription->name }}
                                    </p>

                                    <p class="text-sm text-slate-400">
                                        {{ \Carbon\Carbon::parse($subscription->next_payment_date)->format('d M Y') }}
                                    </p>
                                </div>

                            </div>

                            <p class="font-semibold text-white whitespace-nowrap">
                                €{{ number_format($subscription->price, 2) }}
                            </p>

                        </div>

                    @endforeach

                </div>

            @endif

        </div>

        <!-- Add subscription button -->
        <div class="flex justify-end">

            <a
                href="{{ route('subscriptions.create') }}"
                class="px-5 py-3 rounded-lg bg-purple-600 text-white hover:bg-purple-500 transition"
            >
                + Add Subscription
            </a>

        </div>

    </div>

</x-app-layout>
