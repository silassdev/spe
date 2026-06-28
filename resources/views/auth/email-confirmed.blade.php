<x-guest-layout>
    <div class="space-y-6">
        @if ($status === 'success')
            <!-- Success Status -->
            <div class="text-center space-y-4">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-500/10 dark:bg-emerald-500/5 border border-emerald-500/30 text-emerald-500 mb-2">
                    <!-- Tech Checkmark SVG -->
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <div class="space-y-1">
                    <span class="font-mono-tech text-[10px] text-emerald-500 uppercase tracking-widest block">// CODE: VERIFIED_01 //</span>
                    <h2 class="text-xl font-bold tracking-tight text-slate-900 dark:text-white">Email Confirmed</h2>
                </div>

                <p class="text-sm text-slate-600 dark:text-slate-400">
                    Your email address has been verified. Your Hausify account is now fully activated.
                </p>

                <div class="pt-4 border-t border-slate-100 dark:border-slate-800 font-mono-tech">
                    <a href="{{ route('dashboard') }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-2.5 text-xs font-bold uppercase tracking-wider text-white bg-emerald-500 hover:bg-emerald-600 rounded-lg shadow-md shadow-emerald-500/10 dark:shadow-none transition duration-200">
                        [ LAUNCH_WORKSPACE ]
                    </a>
                </div>
            </div>

        @elseif ($status === 'already')
            <!-- Already Verified Status -->
            <div class="text-center space-y-4">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-500/10 dark:bg-blue-500/5 border border-blue-500/30 text-blue-500 mb-2">
                    <!-- Info/Double Check SVG -->
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <div class="space-y-1">
                    <span class="font-mono-tech text-[10px] text-blue-500 uppercase tracking-widest block">// CODE: ACTIVE_NODE //</span>
                    <h2 class="text-xl font-bold tracking-tight text-slate-900 dark:text-white">Already Verified</h2>
                </div>

                <p class="text-sm text-slate-600 dark:text-slate-400">
                    Your email address was already verified. No additional action is required.
                </p>

                <div class="pt-4 border-t border-slate-100 dark:border-slate-800 font-mono-tech">
                    <a href="{{ route('dashboard') }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-2.5 text-xs font-bold uppercase tracking-wider text-white bg-blue-500 hover:bg-blue-600 rounded-lg shadow-md shadow-blue-500/10 dark:shadow-none transition duration-200">
                        [ GOTO_DASHBOARD ]
                    </a>
                </div>
            </div>

        @else
            <!-- Invalid / Broken / Expired Link Status -->
            <div class="text-center space-y-4">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-rose-500/10 dark:bg-rose-500/5 border border-rose-500/30 text-rose-500 mb-2">
                    <!-- Warning / Exclamation SVG -->
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>

                <div class="space-y-1">
                    <span class="font-mono-tech text-[10px] text-rose-500 uppercase tracking-widest block">// SYS_ERR: LINK_EXPIRED_OR_BROKEN //</span>
                    <h2 class="text-xl font-bold tracking-tight text-slate-900 dark:text-white">Broken Verification Link</h2>
                </div>

                <p class="text-sm text-slate-600 dark:text-slate-400">
                    The verification link is invalid, has expired, or the digital signature is incorrect.
                </p>

                <div class="pt-4 border-t border-slate-100 dark:border-slate-800 space-y-3 font-mono-tech">
                    @auth
                        <!-- If user is logged in, allow them to request a new link directly -->
                        <form method="POST" action="{{ route('verification.send') }}" class="w-full">
                            @csrf
                            <button type="submit" 
                                    class="w-full inline-flex items-center justify-center px-4 py-2.5 text-xs font-bold uppercase tracking-wider text-white bg-slate-800 dark:bg-slate-700 hover:bg-slate-950 dark:hover:bg-slate-600 rounded-lg transition duration-200">
                                [ REQUEST_NEW_LINK ]
                            </button>
                        </form>

                        @if (session('status') == 'verification-link-sent')
                            <p class="text-[10px] text-emerald-500 mt-2 text-left bg-emerald-500/10 p-2 border border-emerald-500/20 rounded">
                                // Verification link resent. Check your inbox.
                            </p>
                        @endif

                        <a href="{{ route('dashboard') }}" 
                           class="w-full inline-flex items-center justify-center px-4 py-2 text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition duration-200">
                            [ BACK_TO_DASHBOARD ]
                        </a>
                    @else
                        <!-- If not logged in, redirect them to login/register -->
                        <a href="{{ route('login') }}" 
                           class="w-full inline-flex items-center justify-center px-4 py-2.5 text-xs font-bold uppercase tracking-wider text-white bg-slate-800 dark:bg-slate-700 hover:bg-slate-950 dark:hover:bg-slate-600 rounded-lg transition duration-200">
                            [ SIGN_IN ]
                        </a>
                        
                        <a href="{{ route('register') }}" 
                           class="w-full inline-flex items-center justify-center px-4 py-2 text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition duration-200">
                            [ REGISTER_ACCOUNT ]
                        </a>
                    @endauth
                </div>
            </div>
        @endif
    </div>
</x-guest-layout>
