
<x-app-layout>

    <div class="max-w-3xl mx-auto">

        <div class="mb-8">
            <a href="{{ route('subscriptions.index') }}"
                class="text-purple-400 hover:text-purple-300 text-sm">
                ← Back to subscriptions
            </a>

            <h1 class="text-3xl font-bold text-white mt-4">
                Add a subscription
            </h1>

            <p class="text-slate-400 mt-2">
                Choose a service or enter your own subscription.
            </p>
        </div>

        <form method="POST" action="{{ route('subscriptions.store') }}"
            class="space-y-6"
            x-data="{
                services: @js($services),
                search: '',
                serviceName: '',
                logoUrl: '',

                get filteredServices() {
                    return this.services.filter(service =>
                        service.name.toLowerCase().includes(this.search.toLowerCase())
                    );
                },

                selectService(service) {
                    this.serviceName = service.name;
                    this.logoUrl = service.logo_url;
                    this.search = service.name;
                },

                chooseCustom() {
                    this.serviceName = '';
                    this.logoUrl = '';
                    this.search = '';
                }
            }">

            @csrf

            <!-- Service selection -->
            <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">

                <h2 class="text-lg font-semibold text-white mb-4">
                    Choose a service
                </h2>

                <label class="block text-sm text-slate-300 mb-2">
                    Search popular services
                </label>

                <input
                    type="text"
                    x-model="search"
                    placeholder="Search Netflix, Spotify, YouTube..."
                    class="w-full rounded-lg bg-slate-800 border border-slate-700 text-white placeholder-slate-500 focus:border-purple-500 focus:ring-purple-500"
                >

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mt-4">

                    <template x-for="service in filteredServices" :key="service.name">
                        <button
                            type="button"
                            @click="selectService(service)"
                            class="flex items-center gap-3 p-3 rounded-lg border transition"
                            :class="serviceName === service.name
                                ? 'border-purple-500 bg-purple-500/10'
                                : 'border-slate-700 bg-slate-800 hover:border-purple-400'"
                        >
                            <img
                                :src="service.logo_url"
                                :alt="service.name + ' logo'"
                                class="w-9 h-9 rounded-lg object-contain bg-white p-1"
                            >

                            <span
                                class="text-sm text-white text-left"
                                x-text="service.name">
                            </span>
                        </button>
                    </template>

                </div>

                <p x-show="filteredServices.length === 0"
                    class="text-slate-400 text-sm mt-4">
                    No matching services found. You can add a custom service below.
                </p>

                <button
                    type="button"
                    @click="chooseCustom()"
                    class="mt-5 text-purple-400 hover:text-purple-300 text-sm">
                    + Add a custom service instead
                </button>

            </div>

            <!-- Service details -->
            <div class="bg-slate-900 border border-slate-800 rounded-xl p-6 space-y-5">

                <h2 class="text-lg font-semibold text-white">
                    Subscription details
                </h2>

                <div>
                    <label class="block text-sm text-slate-300 mb-2">
                        Service name
                    </label>

                    <input
                        type="text"
                        name="name"
                        x-model="serviceName"
                        required
                        maxlength="255"
                        placeholder="Enter service name"
                        class="w-full rounded-lg bg-slate-800 border border-slate-700 text-white"
                    >

                    @error('name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <input type="hidden" name="logo_url" x-model="logoUrl">

                <div x-show="logoUrl" class="flex items-center gap-3">
                    <img :src="logoUrl" alt="Selected service logo"
                        class="w-10 h-10 rounded-lg bg-white p-1 object-contain">

                    <span class="text-sm text-slate-300">
                        Selected service logo
                    </span>
                </div>

                <div>
                    <label class="block text-sm text-slate-300 mb-2">
                        Category
                    </label>

                    <select name="category_id" required
                        class="w-full rounded-lg bg-slate-800 border border-slate-700 text-white">

                        <option value="">Select a category</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                        Description (optional)
                    </label>

                    <textarea name="description" rows="3"
                        placeholder="Add some notes..."
                        class="w-full rounded-lg bg-slate-800 border border-slate-700 text-white">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                    <div>
                        <label class="block text-sm text-slate-300 mb-2">
                            Price
                        </label>

                        <input type="number" name="price" step="0.01" min="0"
                            value="{{ old('price') }}"
                            required
                            placeholder="9.99"
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

                            <option value="">Select cycle</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="quarterly">Quarterly</option>
                            <option value="yearly">Yearly</option>

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
                            value="{{ old('start_date') }}"
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
                            value="{{ old('next_payment_date') }}"
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
                    Add subscription
                </button>
            </div>

        </form>

    </div>

</x-app-layout>
