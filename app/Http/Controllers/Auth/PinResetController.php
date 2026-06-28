<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PinResetController extends Controller
{
    /**
     * Show the security PIN reset screen.
     */
    public function show(): View
    {
        return view('auth.reset-pin');
    }

    /**
     * Process the security PIN reset.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'pin' => ['required', 'string', 'size:6', 'confirmed', 'regex:/^[0-9]+$/'],
        ], [
            'pin.regex' => 'The security PIN must contain only digits.',
        ]);

        $user = Auth::user();
        $user->update([
            'pin' => Hash::make($request->pin),
            'must_reset_pin' => false
        ]);

        return redirect()->route('dashboard')->with('status', 'pin-updated');
    }
}
