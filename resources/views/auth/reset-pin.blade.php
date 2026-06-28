<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center px-4 py-12 bg-slate-950">
        <div class="w-full max-w-md">

            {{-- Corner Decorations --}}
            <div class="relative">
                <span class="absolute -top-3 -left-3 text-rose-500/70 font-mono-tech text-lg select-none">+</span>
                <span class="absolute -top-3 -right-3 text-rose-500/70 font-mono-tech text-lg select-none">+</span>
                <span class="absolute -bottom-3 -left-3 text-rose-500/70 font-mono-tech text-lg select-none">+</span>
                <span class="absolute -bottom-3 -right-3 text-rose-500/70 font-mono-tech text-lg select-none">+</span>

                <div class="bg-slate-900 border border-rose-900/40 rounded-xl shadow-2xl shadow-rose-950/30 overflow-hidden">

                    {{-- Header Bar --}}
                    <div class="border-b border-slate-700/60 bg-slate-800/50 px-8 py-5 flex items-center justify-between">
                        <div>
                            <h1 class="text-rose-400 font-mono-tech text-xl font-bold tracking-widest">// SEC_PIN_RESET</h1>
                            <p class="text-slate-500 font-mono-tech text-xs mt-1 tracking-wider">// CRYPTOCORE SECURITY PROTOCOL</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="h-2 w-2 rounded-full bg-amber-500 animate-pulse"></span>
                            <span class="font-mono-tech text-xs text-amber-500/80 tracking-widest">ACTION_REQ</span>
                        </div>
                    </div>

                    {{-- Admin Warning Notice --}}
                    <div class="mx-8 mt-6">
                        <div class="flex items-start gap-3 bg-rose-950/30 border border-rose-700/50 rounded-lg px-4 py-4">
                            <svg class="w-5 h-5 text-rose-400 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.25-8.25-3.286Zm0 13.036h.008v.008H12v-.008Z" />
                            </svg>
                            <div>
                                <p class="font-mono-tech text-xs font-semibold text-rose-300 tracking-wider mb-1">// ADMIN_NOTICE</p>
                                <p class="font-mono-tech text-xs text-rose-200/80 leading-relaxed">
                                    Your Security PIN has been reset by the administrator. You must define a new 6-digit PIN to continue.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Form Body --}}
                    <div class="px-8 py-7">
                        <form method="POST" action="{{ route('pin.reset') }}" class="space-y-6">
                            @csrf

                            {{-- New PIN --}}
                            <div>
                                <label for="pin" class="block font-mono-tech text-xs font-semibold text-indigo-400 tracking-widest mb-2">
                                    // NEW_SECURITY_PIN
                                </label>
                                <input
                                    id="pin"
                                    name="pin"
                                    type="password"
                                    maxlength="6"
                                    inputmode="numeric"
                                    pattern="\d{6}"
                                    required
                                    autofocus
                                    placeholder="000000"
                                    class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-3.5 text-slate-200 placeholder-slate-600 font-mono-tech text-lg tracking-[0.6em] text-center
                                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                           transition-all duration-200"
                                >
                                <x-input-error :messages="$errors->get('pin')" class="mt-2" />
                            </div>

                            {{-- Confirm PIN --}}
                            <div>
                                <label for="pin_confirmation" class="block font-mono-tech text-xs font-semibold text-indigo-400 tracking-widest mb-2">
                                    // CONFIRM_NEW_PIN
                                </label>
                                <input
                                    id="pin_confirmation"
                                    name="pin_confirmation"
                                    type="password"
                                    maxlength="6"
                                    inputmode="numeric"
                                    pattern="\d{6}"
                                    required
                                    placeholder="000000"
                                    class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-3.5 text-slate-200 placeholder-slate-600 font-mono-tech text-lg tracking-[0.6em] text-center
                                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                           transition-all duration-200"
                                >
                                <x-input-error :messages="$errors->get('pin_confirmation')" class="mt-2" />
                            </div>

                            {{-- PIN Rules Notice --}}
                            <div class="bg-slate-800/60 border border-slate-700/60 rounded-lg px-4 py-4 space-y-2">
                                <p class="font-mono-tech text-xs text-slate-500 tracking-widest mb-3">// PIN_CONSTRAINTS</p>
                                <div class="flex items-center gap-2.5">
                                    <span class="h-1 w-1 rounded-full bg-indigo-500 flex-shrink-0"></span>
                                    <p class="font-mono-tech text-xs text-slate-400">PIN must be exactly <span class="text-indigo-300 font-semibold">6 digits</span>, numbers only (0–9)</p>
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <span class="h-1 w-1 rounded-full bg-rose-500 flex-shrink-0"></span>
                                    <p class="font-mono-tech text-xs text-slate-400">PIN <span class="text-rose-400 font-semibold">cannot be recovered</span> if forgotten — store it securely</p>
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <span class="h-1 w-1 rounded-full bg-amber-500 flex-shrink-0"></span>
                                    <p class="font-mono-tech text-xs text-slate-400">PIN is separate from your account password</p>
                                </div>
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
                                SET_NEW_PIN →
                            </button>

                        </form>
                    </div>

                    {{-- Footer Note --}}
                    <div class="border-t border-slate-700/60 bg-slate-800/30 px-8 py-4">
                        <p class="font-mono-tech text-xs text-slate-600 text-center tracking-wider">
                            // CRYPTOCORE · SECURITY OPERATIONS · {{ date('Y') }}
                        </p>
                    </div>

                </div>
            </div>
            {{-- End relative wrapper --}}

        </div>
    </div>
</x-guest-layout>
