<?php

namespace App\Http\Controllers\Userzone;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): View
    {
        $subscriptions = auth()->user()
            ->subscriptions()
            ->with('category')
            ->where('status', 'active')
            ->get();

        // Calculate monthly spending.
        $monthlyTotal = $subscriptions->sum(function ($subscription) {
            return match ($subscription->billing_cycle) {
                'weekly' => $subscription->price * 52 / 12,
                'monthly' => $subscription->price,
                'quarterly' => $subscription->price / 3,
                'yearly' => $subscription->price / 12,
                default => 0,
            };
        });

        $yearlyTotal = $monthlyTotal * 12;
        $activeCount = $subscriptions->count();

        $categorySpending = $subscriptions
            ->groupBy(function ($subscription) {
                return $subscription->category?->name ?? 'Uncategorized';
            })
            ->map(function ($categorySubscriptions) {
                return $categorySubscriptions->sum(function ($subscription) {
                    return match ($subscription->billing_cycle) {
                        'weekly' => $subscription->price * 52 / 12,
                        'monthly' => $subscription->price,
                        'quarterly' => $subscription->price / 3,
                        'yearly' => $subscription->price / 12,
                        default => 0,
                    };
                });
            })
            ->sortDesc();

        $upcomingPayments = auth()->user()
            ->subscriptions()
            ->with('category')
            ->where('status', 'active')
            ->whereBetween('next_payment_date', [
                now()->toDateString(),
                now()->addDays(30)->toDateString(),
            ])
            ->orderBy('next_payment_date')
            ->get();

        return view('userzone.dashboard', compact(
            'monthlyTotal',
            'yearlyTotal',
            'activeCount',
            'upcomingPayments',
            'categorySpending'
        ));
    }
}