<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center px-4 py-12 bg-slate-950">
        <div class="w-full max-w-md">

            {{-- Corner Decorations --}}
            <div class="relative">
                <span class="absolute -top-3 -left-3 text-indigo-500 font-mono-tech text-lg select-none">+</span>
                <span class="absolute -top-3 -right-3 text-indigo-500 font-mono-tech text-lg select-none">+</span>
                <span class="absolute -bottom-3 -left-3 text-indigo-500 font-mono-tech text-lg select-none">+</span>
                <span class="absolute -bottom-3 -right-3 text-indigo-500 font-mono-tech text-lg select-none">+</span>

                <div class="bg-slate-900 border border-slate-700/60 rounded-xl shadow-2xl shadow-indigo-950/40 overflow-hidden">

                    {{-- Header Bar --}}
                    <div class="border-b border-slate-700/60 bg-slate-800/50 px-8 py-5 flex items-center justify-between">
                        <div>
                            <h1 class="text-indigo-400 font-mono-tech text-xl font-bold tracking-widest">// AUTHENTICATE_NODE</h1>
                            <p class="text-slate-500 font-mono-tech text-xs mt-1 tracking-wider">// CRYPTOCORE SECURE ACCESS</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span class="font-mono-tech text-xs text-slate-500 tracking-widest">ONLINE</span>
                        </div>
                    </div>

                    {{-- Session Status --}}
                    @if (session('status'))
                        <div class="mx-8 mt-6 flex items-start gap-3 bg-emerald-950/40 border border-emerald-700/40 rounded-lg px-4 py-3">
                            <svg class="w-4 h-4 text-emerald-400 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <x-auth-session-status class="font-mono-tech text-xs text-emerald-300" :status="session('status')" />
                        </div>
                    @endif

                    {{-- Form Body --}}
                    <div class="px-8 py-8">
                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf

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
                                    autofocus
                                    autocomplete="email"
                                    placeholder="you@example.com"
                                    class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-3 text-slate-200 placeholder-slate-600 font-mono-tech text-sm
                                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                           transition-all duration-200"
                                >
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            {{-- Password --}}
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <label for="password" class="block font-mono-tech text-xs font-semibold text-indigo-400 tracking-widest">
                                        // PASSWORD
                                    </label>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="font-mono-tech text-xs text-slate-500 hover:text-indigo-400 tracking-wider transition-colors">
                                            FORGOT?
                                        </a>
                                    @endif
                                </div>
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="••••••••"
                                    class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-3 text-slate-200 placeholder-slate-600 font-mono-tech text-sm
                                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                           transition-all duration-200"
                                >
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            {{-- Remember Me --}}
                            <div class="flex items-center gap-3">
                                <input
                                    id="remember_me"
                                    name="remember"
                                    type="checkbox"
                                    class="h-4 w-4 rounded border-slate-600 bg-slate-800 text-indigo-600
                                           focus:ring-indigo-500 focus:ring-offset-slate-900 cursor-pointer"
                                >
                                <label for="remember_me" class="font-mono-tech text-xs text-slate-400 cursor-pointer tracking-wider">
                                    // KEEP_SESSION_ALIVE
                                </label>
                            </div>

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
                                AUTHENTICATE →
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
                        <span class="font-mono-tech text-xs text-slate-500">// No account yet?</span>
                        <a href="{{ route('register') }}" class="font-mono-tech text-xs text-indigo-400 hover:text-indigo-300 font-semibold tracking-wider transition-colors">
                            CREATE_ACCOUNT →
                        </a>
                    </div>

                </div>
            </div>
            {{-- End relative wrapper --}}

        </div>
    </div>
</x-guest-layout>
