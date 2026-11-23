<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-white">Create Reminder</h2>
            <p class="text-slate-400 text-sm mt-1">Set a reminder for an upcoming subscription payment.</p>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-8">

            <div class="mb-6">
                <p class="text-sm text-slate-400">Subscription</p>
                <h3 class="text-xl font-semibold text-white mt-1">
                    {{ $subscription->name }}
                </h3>
            </div>

            <form method="POST" action="{{ route('reminders.store', $subscription) }}">
                @csrf

                <div class="mb-6">
                    <label for="reminder_date" class="block text-sm font-medium text-slate-300 mb-2">
                        Reminder date
                    </label>

                    <input
                        type="date"
                        id="reminder_date"
                        name="reminder_date"
                        value="{{ old('reminder_date') }}"
                        required
                        class="w-full bg-slate-800 border border-slate-700 text-white rounded-xl px-4 py-3 focus:ring-purple-500 focus:border-purple-500"
                    >

                    @error('reminder_date')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="message" class="block text-sm font-medium text-slate-300 mb-2">
                        Reminder message
                    </label>

                    <textarea
                        id="message"
                        name="message"
                        rows="4"
                        maxlength="255"
                        required
                        placeholder="Example: Your subscription payment is coming up!"
                        class="w-full bg-slate-800 border border-slate-700 text-white rounded-xl px-4 py-3 focus:ring-purple-500 focus:border-purple-500"
                    >{{ old('message') }}</textarea>

                    @error('message')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3">
                    <a
                        href="{{ route('reminders.index') }}"
                        class="px-5 py-3 rounded-xl text-slate-300 hover:bg-slate-800 transition"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl transition"
                    >
                        Create Reminder
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
