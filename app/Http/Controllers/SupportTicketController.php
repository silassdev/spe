<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportTicketController extends Controller
{
    /**
     * Display support tickets list and creation form.
     */
    public function index()
    {
        $user = Auth::user();
        $tickets = SupportTicket::where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('user.support', [
            'user' => $user,
            'tickets' => $tickets,
        ]);
    }

    /**
     * Open a new support ticket.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $user = Auth::user();
        
        SupportTicket::create([
            'user_id' => $user->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'open',
        ]);

        return redirect()->route('support')->with('status', 'ticket-created');
    }
}
