<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Referral;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request): View
    {
        return view('auth.register', [
            'referrer' => $request->query('ref')
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'alpha_num', 'min:3', 'max:50', 'unique:'.User::class],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:30'],
            'country' => ['required', 'string', 'max:100'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'pin' => ['required', 'string', 'size:6', 'confirmed'], // 6-digit Security PIN
            'accept_terms' => ['accepted'],
        ]);

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'password' => Hash::make($request->password),
            'pin' => Hash::make($request->pin), // separate PIN hashing
            'must_reset_pin' => false,
            'wallet_balance' => 0.00,
            'status' => 'active',
            'role' => 'user',
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Handle referral tracking
        if ($request->filled('referrer')) {
            $referrer = User::where('username', $request->referrer)->first();
            if ($referrer && $referrer->id !== $user->id) {
                Referral::create([
                    'referrer_id' => $referrer->id,
                    'referred_id' => $user->id,
                    'commission' => 0.00, // Updated later upon investment upgrades
                ]);
            }
        }

        return redirect(route('dashboard', absolute: false));
    }
}
