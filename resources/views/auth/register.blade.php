<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center px-4 py-12 bg-slate-950">
        <div class="w-full max-w-2xl">

            {{-- Corner Decorations --}}
            <div class="relative">
                {{-- Top-left corner --}}
                <span class="absolute -top-3 -left-3 text-indigo-500 font-mono-tech text-lg select-none">+</span>
                {{-- Top-right corner --}}
                <span class="absolute -top-3 -right-3 text-indigo-500 font-mono-tech text-lg select-none">+</span>
                {{-- Bottom-left corner --}}
                <span class="absolute -bottom-3 -left-3 text-indigo-500 font-mono-tech text-lg select-none">+</span>
                {{-- Bottom-right corner --}}
                <span class="absolute -bottom-3 -right-3 text-indigo-500 font-mono-tech text-lg select-none">+</span>

                <div class="bg-slate-900 border border-slate-700/60 rounded-xl shadow-2xl shadow-indigo-950/40 overflow-hidden">

                    {{-- Header Bar --}}
                    <div class="border-b border-slate-700/60 bg-slate-800/50 px-8 py-5 flex items-center justify-between">
                        <div>
                            <h1 class="text-indigo-400 font-mono-tech text-xl font-bold tracking-widest">// CREATE_ACCOUNT</h1>
                            <p class="text-slate-500 font-mono-tech text-xs mt-1 tracking-wider">// CRYPTOCORE MEMBERSHIP REGISTRATION</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span class="font-mono-tech text-xs text-slate-500 tracking-widest">NODE_OPEN</span>
                        </div>
                    </div>

                    {{-- Form Body --}}
                    <div class="px-8 py-8">
                        <form method="POST" action="{{ route('register') }}" class="space-y-6">
                            @csrf

                            {{-- Hidden referral code --}}
                            <input type="hidden" name="referrer" value="{{ old('referrer', $referrer ?? '') }}">

                            {{-- Full Name --}}
                            <div>
                                <label for="name" class="block font-mono-tech text-xs font-semibold text-indigo-400 tracking-widest mb-2">
                                    // FULL_NAME
                                </label>
                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    value="{{ old('name') }}"
                                    required
                                    autocomplete="name"
                                    placeholder="Enter your full name"
                                    class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-3 text-slate-200 placeholder-slate-600 font-mono-tech text-sm
                                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                           transition-all duration-200"
                                >
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            {{-- Username --}}
                            <div>
                                <label for="username" class="block font-mono-tech text-xs font-semibold text-indigo-400 tracking-widest mb-2">
                                    // USERNAME
                                </label>
                                <input
                                    id="username"
                                    name="username"
                                    type="text"
                                    value="{{ old('username') }}"
                                    required
                                    autocomplete="username"
                                    placeholder="letters and numbers only"
                                    class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-3 text-slate-200 placeholder-slate-600 font-mono-tech text-sm
                                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                           transition-all duration-200"
                                >
                                <p class="mt-1.5 font-mono-tech text-xs text-slate-500 tracking-wide">// letters and numbers only — no spaces or symbols</p>
                                <x-input-error :messages="$errors->get('username')" class="mt-2" />
                            </div>

                            {{-- Email --}}
                            <div>
                                <label for="email" class="block font-mono-tech text-xs font-semibold text-indigo-400 tracking-widest mb-2">
                                    // EMAIL_ADDRESS
                                </label>
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                    placeholder="you@example.com"
                                    class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-3 text-slate-200 placeholder-slate-600 font-mono-tech text-sm
                                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                           transition-all duration-200"
                                >
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            {{-- Phone + Country (2-column grid) --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                {{-- Phone --}}
                                <div>
                                    <label for="phone" class="block font-mono-tech text-xs font-semibold text-indigo-400 tracking-widest mb-2">
                                        // PHONE_NUMBER
                                    </label>
                                    <input
                                        id="phone"
                                        name="phone"
                                        type="tel"
                                        value="{{ old('phone') }}"
                                        required
                                        autocomplete="tel"
                                        placeholder="+1 000 000 0000"
                                        class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-3 text-slate-200 placeholder-slate-600 font-mono-tech text-sm
                                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                               transition-all duration-200"
                                    >
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>

                                {{-- Country --}}
                                <div>
                                    <label for="country" class="block font-mono-tech text-xs font-semibold text-indigo-400 tracking-widest mb-2">
                                        // COUNTRY
                                    </label>
                                    <input
                                        id="country"
                                        name="country"
                                        type="text"
                                        value="{{ old('country') }}"
                                        required
                                        autocomplete="country-name"
                                        placeholder="e.g. United States"
                                        class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-3 text-slate-200 placeholder-slate-600 font-mono-tech text-sm
                                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                               transition-all duration-200"
                                    >
                                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                                </div>
                            </div>

                            {{-- Password + Confirm Password --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label for="password" class="block font-mono-tech text-xs font-semibold text-indigo-400 tracking-widest mb-2">
                                        // PASSWORD
                                    </label>
                                    <input
                                        id="password"
                                        name="password"
                                        type="password"
                                        required
                                        autocomplete="new-password"
                                        placeholder="••••••••"
                                        class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-3 text-slate-200 placeholder-slate-600 font-mono-tech text-sm
                                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                               transition-all duration-200"
                                    >
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block font-mono-tech text-xs font-semibold text-indigo-400 tracking-widest mb-2">
                                        // CONFIRM_PASSWORD
                                    </label>
                                    <input
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        type="password"
                                        required
                                        autocomplete="new-password"
                                        placeholder="••••••••"
                                        class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-3 text-slate-200 placeholder-slate-600 font-mono-tech text-sm
                                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                               transition-all duration-200"
                                    >
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                            </div>

                            {{-- Security PIN Divider --}}
                            <div class="flex items-center gap-3 py-1">
                                <div class="flex-1 h-px bg-slate-700/80"></div>
                                <span class="font-mono-tech text-xs text-amber-400/80 tracking-widest whitespace-nowrap">// SECURITY_LAYER</span>
                                <div class="flex-1 h-px bg-slate-700/80"></div>
                            </div>

                            {{-- Security PIN + Confirm PIN --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label for="pin" class="block font-mono-tech text-xs font-semibold text-indigo-400 tracking-widest mb-2">
                                        // SECURITY_PIN
                                    </label>
                                    <input
                                        id="pin"
                                        name="pin"
                                        type="password"
                                        maxlength="6"
                                        inputmode="numeric"
                                        required
                                        placeholder="000000"
                                        class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-3 text-slate-200 placeholder-slate-600 font-mono-tech text-sm tracking-[0.5em]
                                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                               transition-all duration-200"
                                    >
                                    <x-input-error :messages="$errors->get('pin')" class="mt-2" />
                                </div>

                                <div>
                                    <label for="pin_confirmation" class="block font-mono-tech text-xs font-semibold text-indigo-400 tracking-widest mb-2">
                                        // CONFIRM_PIN
                                    </label>
                                    <input
                                        id="pin_confirmation"
                                        name="pin_confirmation"
                                        type="password"
                                        maxlength="6"
                                        inputmode="numeric"
                                        required
                                        placeholder="000000"
                                        class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-3 text-slate-200 placeholder-slate-600 font-mono-tech text-sm tracking-[0.5em]
                                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                               transition-all duration-200"
                                    >
                                    <x-input-error :messages="$errors->get('pin_confirmation')" class="mt-2" />
                                </div>
                            </div>

                            {{-- PIN Warning Notice --}}
                            <div class="flex items-start gap-3 bg-amber-950/30 border border-amber-700/40 rounded-lg px-4 py-3">
                                <svg class="w-4 h-4 text-amber-400 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                </svg>
                                <p class="font-mono-tech text-xs text-amber-300/80 leading-relaxed">
                                    // This PIN is separate from your password and is <span class="text-amber-400 font-bold">never recoverable</span>. Store it safely — it is required for sensitive account operations.
                                </p>
                            </div>

                            {{-- Terms & Conditions --}}
                            <div class="flex items-start gap-3">
                                <div class="flex items-center h-5 mt-0.5">
                                    <input
                                        id="accept_terms"
                                        name="accept_terms"
                                        type="checkbox"
                                        value="1"
                                        {{ old('accept_terms') ? 'checked' : '' }}
                                        class="h-4 w-4 rounded border-slate-600 bg-slate-800 text-indigo-600
                                               focus:ring-indigo-500 focus:ring-offset-slate-900 cursor-pointer"
                                    >
                                </div>
                                <label for="accept_terms" class="font-mono-tech text-xs text-slate-400 leading-relaxed cursor-pointer">
                                    // I agree to the
                                    <a href="#" class="text-indigo-400 hover:text-indigo-300 underline underline-offset-2 transition-colors">Terms of Service</a>
                                    and
                                    <a href="#" class="text-indigo-400 hover:text-indigo-300 underline underline-offset-2 transition-colors">Privacy Policy</a>.
                                    I understand the risks associated with cryptocurrency platforms.
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('accept_terms')" class="-mt-4" />

                            {{-- Submit Button --}}
                            <button
                                type="submit"
                                class="w-full bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 text-white
                                       font-mono-tech font-bold text-sm tracking-widest
                                       py-3.5 px-6 rounded-lg
                                       transition-all duration-200
                                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-slate-900
                                       shadow-lg shadow-indigo-950/50"
                            >
                                REGISTER_ACCOUNT →
                            </button>

                            {{-- Separator --}}
                            <div class="flex items-center gap-3">
                                <div class="flex-1 h-px bg-slate-700/60"></div>
                                <span class="font-mono-tech text-xs text-slate-600 tracking-widest">OR</span>
                                <div class="flex-1 h-px bg-slate-700/60"></div>
                            </div>

                            {{-- Google Sign-In --}}
                            <a
                                href="{{ route('auth.google') }}"
                                class="w-full flex items-center justify-center gap-3
                                       bg-slate-800 hover:bg-slate-700 border border-slate-700 hover:border-slate-600
                                       text-slate-300 font-mono-tech text-xs font-semibold tracking-wider
                                       py-3.5 px-6 rounded-lg
                                       transition-all duration-200
                                       focus:outline-none focus:ring-2 focus:ring-slate-500"
                            >
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none">
                                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                                </svg>
                                CONTINUE_WITH_GOOGLE
                            </a>

                        </form>
                    </div>

                    {{-- Footer --}}
                    <div class="border-t border-slate-700/60 bg-slate-800/30 px-8 py-4 flex items-center justify-center gap-2">
                        <span class="font-mono-tech text-xs text-slate-500">// Already have an account?</span>
                        <a href="{{ route('login') }}" class="font-mono-tech text-xs text-indigo-400 hover:text-indigo-300 font-semibold tracking-wider transition-colors">
                            AUTHENTICATE →
                        </a>
                    </div>

                </div>
            </div>
            {{-- End relative wrapper --}}

        </div>
    </div>
</x-guest-layout>
