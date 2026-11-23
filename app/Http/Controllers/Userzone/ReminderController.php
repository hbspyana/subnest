<?php

namespace App\Http\Controllers\Userzone;

use App\Http\Controllers\Controller;
use App\Models\Reminder;
use App\Models\Subscription;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = Reminder::whereHas('subscription', function ($query) {
            $query->where('user_id', auth()->id());
        })
            ->with('subscription')
            ->orderBy('reminder_date')
            ->get();

        return view('userzone.reminders.index', compact('reminders'));
    }

    public function create(Subscription $subscription)
    {
        abort_unless($subscription->user_id === auth()->id(), 403);

        return view('userzone.reminders.create', compact('subscription'));
    }

    public function store(Request $request, Subscription $subscription)
    {
        abort_unless($subscription->user_id === auth()->id(), 403);
        $validated = $request->validate([
            'reminder_date' => ['required', 'date'],
            'message' => ['required', 'string', 'max:255'],
        ]);

        $subscription->reminders()->create($validated);

        return redirect()->route('reminders.index')
            ->with('success', 'Reminder created successfully!');
    }

    public function updateRead(Reminder $reminder)
    {
        $this->authorizeReminder($reminder);
        $reminder->update([
            'is_read' => !$reminder->is_read,
        ]);

        return redirect()->route('reminders.index')
            ->with('success', 'Reminder updated successfully!');
    }

    public function destroy(Reminder $reminder)
    {
        $this->authorizeReminder($reminder);
        $reminder->delete();

        return redirect()->route('reminders.index')
            ->with('success', 'Reminder deleted successfully!');
    }

    private function authorizeReminder(Reminder $reminder)
    {
        abort_unless(
            $reminder->subscription->user_id === auth()->id(),
            403
        );
    }
}
