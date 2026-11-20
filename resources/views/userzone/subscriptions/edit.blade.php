
<x-app-layout>

    <div class="max-w-3xl mx-auto">

        <div class="mb-8">
            <a href="{{ route('subscriptions.index') }}"
                class="text-purple-400 hover:text-purple-300 text-sm">
                ← Back to subscriptions
            </a>

            <h1 class="text-3xl font-bold text-white mt-4">
                Edit Subscription
            </h1>

            <p class="text-slate-400 mt-2">
                Update your subscription details.
            </p>
        </div>

        <form method="POST"
            action="{{ route('subscriptions.update', $subscription) }}"
            class="space-y-6">

            @csrf
            @method('PUT')

            <div class="bg-slate-900 border border-slate-800 rounded-xl p-6 space-y-5">

                <div>
                    <label class="block text-sm text-slate-300 mb-2">
                        Service name
                    </label>

                    <input type="text" name="name"
                        value="{{ old('name', $subscription->name) }}"
                        required
                        class="w-full rounded-lg bg-slate-800 border border-slate-700 text-white">

                    @error('name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm text-slate-300 mb-2">
                        Logo URL
                    </label>

                    <input type="url" name="logo_url"
                        value="{{ old('logo_url', $subscription->logo_url) }}"
                        placeholder="https://example.com/logo.png"
                        class="w-full rounded-lg bg-slate-800 border border-slate-700 text-white">

                    @error('logo_url')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    @if ($subscription->logo_url)
                        <div class="mt-3 flex items-center gap-3">
                            <img src="{{ $subscription->logo_url }}"
                                alt="{{ $subscription->name }} logo"
                                class="w-10 h-10 rounded-lg bg-white p-1 object-contain">

                            <span class="text-sm text-slate-400">
                                Current logo
                            </span>
                        </div>
                    @endif
                </div>

                <div>
                    <label class="block text-sm text-slate-300 mb-2">
                        Category
                    </label>

                    <select name="category_id" required
                        class="w-full rounded-lg bg-slate-800 border border-slate-700 text-white">

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $subscription->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>

                    @error('category_id')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm text-slate-300 mb-2">
                        Description
                    </label>

                    <textarea name="description" rows="3"
                        class="w-full rounded-lg bg-slate-800 border border-slate-700 text-white">{{ old('description', $subscription->description) }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                    <div>
                        <label class="block text-sm text-slate-300 mb-2">
                            Price
                        </label>

                        <input type="number" name="price" step="0.01" min="0"
                            value="{{ old('price', $subscription->price) }}"
                            required
                            class="w-full rounded-lg bg-slate-800 border border-slate-700 text-white">

                        @error('price')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm text-slate-300 mb-2">
                            Billing cycle
                        </label>

                        <select name="billing_cycle" required
                            class="w-full rounded-lg bg-slate-800 border border-slate-700 text-white">

                            @foreach (['weekly', 'monthly', 'quarterly', 'yearly'] as $cycle)
                                <option value="{{ $cycle }}"
                                    {{ old('billing_cycle', $subscription->billing_cycle) === $cycle ? 'selected' : '' }}>
                                    {{ ucfirst($cycle) }}
                                </option>
                            @endforeach

                        </select>

                        @error('billing_cycle')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm text-slate-300 mb-2">
                            Start date
                        </label>

                        <input type="date" name="start_date"
                            value="{{ old('start_date', $subscription->start_date) }}"
                            required
                            class="w-full rounded-lg bg-slate-800 border border-slate-700 text-white">

                        @error('start_date')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm text-slate-300 mb-2">
                            Next payment date
                        </label>

                        <input type="date" name="next_payment_date"
                            value="{{ old('next_payment_date', $subscription->next_payment_date) }}"
                            required
                            class="w-full rounded-lg bg-slate-800 border border-slate-700 text-white">

                        @error('next_payment_date')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

            </div>

            <div class="flex justify-end gap-3">

                <a href="{{ route('subscriptions.index') }}"
                    class="px-5 py-3 rounded-lg bg-slate-800 text-slate-300 hover:bg-slate-700">
                    Cancel
                </a>

                <button type="submit"
                    class="px-5 py-3 rounded-lg bg-purple-600 text-white hover:bg-purple-500">
                    Save Changes
                </button>

            </div>

        </form>

    </div>

</x-app-layout>
