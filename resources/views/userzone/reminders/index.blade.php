<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-white">Reminders</h2>
            <p class="text-slate-400 text-sm mt-1">Keep track of your upcoming subscription payments.</p>
        </div>
    </x-slot>

    <div class="space-y-6">

        @if (session('success'))
            <div class="bg-green-500/10 border border-green-500/20 text-green-400 px-5 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-xl font-semibold text-white">Your reminders</h3>
                <p class="text-slate-400 text-sm mt-1">
                    {{ $reminders->count() }} reminders in total
                </p>
            </div>

            <a href="{{ route('subscriptions.index') }}"
               class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-3 rounded-xl transition">
                View subscriptions
            </a>
        </div>

        @if ($reminders->isEmpty())
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-12 text-center">
                <div class="text-5xl mb-4">🔔</div>
                <h3 class="text-xl font-semibold text-white mb-2">No reminders yet</h3>
                <p class="text-slate-400 mb-6">
                    Create reminders for your subscriptions to keep track of upcoming payments.
                </p>
                <a href="{{ route('subscriptions.index') }}"
                   class="inline-block bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl transition">
                    Go to subscriptions
                </a>
            </div>
        @else
            <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-800/60 text-slate-400 text-sm">
                            <tr>
                                <th class="px-6 py-4 font-medium">Subscription</th>
                                <th class="px-6 py-4 font-medium">Reminder</th>
                                <th class="px-6 py-4 font-medium">Date</th>
                                <th class="px-6 py-4 font-medium">Status</th>
                                <th class="px-6 py-4 font-medium">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-800">
                            @foreach ($reminders as $reminder)
                                <tr class="hover:bg-slate-800/40 transition">
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $reminder->subscription->name }}
                                    </td>

                                    <td class="px-6 py-4 text-slate-300">
                                        {{ $reminder->message }}
                                    </td>

                                    <td class="px-6 py-4 text-slate-300">
                                        {{ \Carbon\Carbon::parse($reminder->reminder_date)->format('M d, Y') }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @if ($reminder->is_read)
                                            <span class="bg-slate-700 text-slate-300 px-3 py-1 rounded-full text-xs">
                                                Read
                                            </span>
                                        @else
                                            <span class="bg-purple-500/10 text-purple-400 px-3 py-1 rounded-full text-xs">
                                                Unread
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <form method="POST" action="{{ route('reminders.updateRead', $reminder) }}">
                                                @csrf
                                                @method('PATCH')

                                                <button type="submit" class="text-purple-400 hover:text-purple-300 text-sm">
                                                    Mark as {{ $reminder->is_read ? 'unread' : 'read' }}
                                                </button>
                                            </form>

                                            <form method="POST" action="{{ route('reminders.destroy', $reminder) }}"
                                                  onsubmit="return confirm('Are you sure you want to delete this reminder?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="text-red-400 hover:text-red-300 text-sm">
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
</x-app-layout>
