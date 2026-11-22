<?php

namespace App\Http\Controllers\Userzone;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::whereHas('subscription', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->with('subscription')
            ->orderByDesc('payment_date')
            ->get();

        return view('userzone.payments.index', compact('payments'));
    }

    public function create(Subscription $subscription)
    {
        $this->authorizeSubscription($subscription);

        return view('userzone.payments.create', compact('subscription'));
    }

    public function store(Request $request, Subscription $subscription)
    {
        $this->authorizeSubscription($subscription);

        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0'],
            'payment_date' => ['required', 'date'],
            'status' => [
                'required',
                Rule::in(['paid', 'pending']),
            ],
        ]);

        $subscription->payments()->create($validated);

        return redirect()->route('payments.index')
            ->with('success', 'Payment recorded successfully!');
    }

    public function updateStatus(Request $request, Payment $payment)
    {
        $this->authorizePayment($payment);

        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in(['paid', 'pending']),
            ],
        ]);

        $payment->update($validated);

        return redirect()->route('payments.index')
            ->with('success', 'Payment status updated!');
    }

    public function destroy(Payment $payment)
    {
        $this->authorizePayment($payment);

        $payment->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Payment deleted successfully!');
    }

    private function authorizeSubscription(Subscription $subscription)
    {
        abort_unless($subscription->user_id === auth()->id(), 403);
    }

    private function authorizePayment(Payment $payment)
    {
        abort_unless(
            $payment->subscription->user_id === auth()->id(),
            403
        );
    }
}
