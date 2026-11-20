<?php

namespace App\Http\Controllers\Userzone;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = auth()->user()
            ->subscriptions()
            ->with('category')
            ->latest()
            ->get();

        return view('userzone.subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        $categories = auth()->user()->categories;
        $services = config('subscription_services');

        return view(
            'userzone.subscriptions.create',
            compact('categories', 'services')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')
                    ->where('user_id', auth()->id()),
            ],
            'name' => ['required', 'string', 'max:255'],
            'logo_url' => ['nullable', 'url', 'max:2048'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'billing_cycle' => [
                'required',
                Rule::in(['weekly', 'monthly', 'quarterly', 'yearly']),
            ],
            'start_date' => ['required', 'date'],
            'next_payment_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
            ],
        ]);

        auth()->user()->subscriptions()->create($validated);

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription added successfully!');
    }


    public function edit(Subscription $subscription)
    {
        $this->authorizeSubscription($subscription);

        $categories = auth()->user()->categories;

        return view(
            'userzone.subscriptions.edit',
            compact('subscription', 'categories')
        );
    }

    public function update(Request $request, Subscription $subscription)
    {
        $this->authorizeSubscription($subscription);

        $validated = $request->validate([
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')
                    ->where('user_id', auth()->id()),
            ],
            'name' => ['required', 'string', 'max:255'],
            'logo_url' => ['nullable', 'url', 'max:2048'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'billing_cycle' => [
                'required',
                Rule::in(['weekly', 'monthly', 'quarterly', 'yearly']),
            ],
            'start_date' => ['required', 'date'],
            'next_payment_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
            ],
        ]);

        $subscription->update($validated);

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription updated successfully!');
    }

    public function destroy(Subscription $subscription)
    {
        $this->authorizeSubscription($subscription);

        $subscription->delete();

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription deleted successfully!');
    }

    private function authorizeSubscription(Subscription $subscription)
    {
        abort_unless($subscription->user_id === auth()->id(), 403);
    }

}
