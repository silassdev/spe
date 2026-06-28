<header
    x-data="{ open: false, dark: false }"
    x-init="dark = document.documentElement.classList.contains('dark')"
    class="sticky top-0 z-50 border-b border-slate-200 dark:border-slate-800/60 bg-white/90 dark:bg-slate-950/90 backdrop-blur-md transition-colors duration-300"
>
    <!-- Border Grid Decoration Plus Signs -->
    <div class="absolute -bottom-1.5 -left-1.5 z-10 text-slate-400 dark:text-slate-600 font-mono text-xs select-none pointer-events-none">+</div>
    <div class="absolute -bottom-1.5 -right-1.5 z-10 text-slate-400 dark:text-slate-600 font-mono text-xs select-none pointer-events-none">+</div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 border-l border-r border-slate-200/60 dark:border-slate-800/40">
        <div class="flex h-20 items-center justify-between">
            
            <!-- Brand Logo -->
            <a href="/" class="flex items-center gap-3 group">
                <div class="relative flex h-11 w-11 items-center justify-center rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 font-black text-white shadow-md shadow-indigo-500/20 transition-all duration-300 group-hover:scale-105 group-hover:shadow-indigo-500/35 font-mono-tech">
                    C
                    <!-- Tech box corner ticks -->
                    <div class="absolute top-0.5 left-0.5 w-1 h-1 bg-white/40 rounded-full"></div>
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="font-bold text-lg tracking-tight text-slate-900 dark:text-white">CryptoCore</span>
                        <span class="font-mono-tech text-[10px] bg-slate-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-slate-500 dark:text-slate-400 border border-slate-200 dark:border-slate-700/50">v1.0</span>
                    </div>
                    <div class="text-[10px] font-mono-tech uppercase tracking-widest text-slate-400 dark:text-slate-500">
                        SYS // CRYPTO_MEMBERSHIP
                    </div>
                </div>
            </a>

            <!-- Center Navigation Links -->
            <nav class="hidden md:flex items-center border-l border-r border-slate-200 dark:border-slate-800 px-8 py-2 gap-8 h-full">
                <a href="#features" class="text-sm font-mono-tech uppercase tracking-wider text-slate-600 dark:text-slate-400 hover:text-emerald-500 dark:hover:text-emerald-400 transition-colors duration-200">
                    <span class="text-emerald-500 dark:text-emerald-400 mr-0.5">//</span> 01. Features
                </a>
                <a href="#how-it-works" class="text-sm font-mono-tech uppercase tracking-wider text-slate-600 dark:text-slate-400 hover:text-emerald-500 dark:hover:text-emerald-400 transition-colors duration-200">
                    <span class="text-emerald-500 dark:text-emerald-400 mr-0.5">//</span> 02. Operations
                </a>
                <a href="#pricing" class="text-sm font-mono-tech uppercase tracking-wider text-slate-600 dark:text-slate-400 hover:text-emerald-500 dark:hover:text-emerald-400 transition-colors duration-200">
                    <span class="text-emerald-500 dark:text-emerald-400 mr-0.5">//</span> 03. Pricing
                </a>
                <a href="#contact" class="text-sm font-mono-tech uppercase tracking-wider text-slate-600 dark:text-slate-400 hover:text-emerald-500 dark:hover:text-emerald-400 transition-colors duration-200">
                    <span class="text-emerald-500 dark:text-emerald-400 mr-0.5">//</span> 04. Contact
                </a>
            </nav>

            <!-- Actions (Theme Toggle & Auth) -->
            <div class="flex items-center gap-4">
                <!-- Theme Toggle Button -->
                <button 
                    @click="
                        dark = !dark; 
                        if(dark) { 
                            document.documentElement.classList.add('dark'); 
                            localStorage.setItem('theme', 'dark'); 
                        } else { 
                            document.documentElement.classList.remove('dark'); 
                            localStorage.setItem('theme', 'light'); 
                        }
                    "
                    class="relative p-2.5 rounded-lg border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/60 text-slate-600 dark:text-slate-400 hover:text-emerald-500 dark:hover:text-emerald-400 hover:border-emerald-500/50 dark:hover:border-emerald-400/50 transition-all duration-200 group"
                    aria-label="Toggle Theme"
                >
                    <!-- Sun Icon (visible in Dark mode) -->
                    <svg x-show="dark" class="w-5 h-5 transition-transform duration-300 group-hover:rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                    </svg>
                    <!-- Moon Icon (visible in Light mode) -->
                    <svg x-show="!dark" class="w-5 h-5 transition-transform duration-300 group-hover:-rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <span class="absolute -top-1 -right-1 flex h-2 w-2" x-show="!localStorage.getItem('theme')">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                </button>

                <!-- Auth Buttons -->
                <div class="hidden sm:flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="font-mono-tech text-xs uppercase tracking-wider rounded-lg border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/60 text-slate-800 dark:text-slate-200 px-4 py-2.5 hover:bg-slate-100 dark:hover:bg-slate-800 transition duration-200">
                            [ Dashboard ]
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="font-mono-tech text-xs uppercase tracking-wider text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white px-2 py-1.5 transition">
                            Login
                        </a>

                        <a href="{{ route('register') }}"
                           class="relative overflow-hidden font-mono-tech text-xs uppercase tracking-wider rounded-lg bg-indigo-600 text-white px-5 py-2.5 font-bold shadow-md shadow-indigo-600/20 hover:bg-indigo-500 transition-all duration-200 hover:shadow-indigo-600/35 group">
                            <span class="relative z-10">Get Started &rarr;</span>
                            <div class="absolute inset-0 -translate-x-full group-hover:translate-x-0 bg-gradient-to-r from-indigo-600 to-purple-500 transition-transform duration-300 -z-0"></div>
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button
                    @click="open = !open"
                    class="md:hidden p-2 rounded-lg border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900/60"
                    aria-label="Toggle Menu"
                >
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        @click.outside="open = false"
        class="md:hidden border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 py-4 px-6 shadow-xl"
        style="display: none;"
    >
        <div class="flex flex-col gap-4">
            <a href="#features" @click="open = false" class="font-mono-tech text-sm uppercase tracking-wider text-slate-600 dark:text-slate-400 hover:text-emerald-500 py-2 border-b border-slate-100 dark:border-slate-900">
                01. Features
            </a>
            <a href="#how-it-works" @click="open = false" class="font-mono-tech text-sm uppercase tracking-wider text-slate-600 dark:text-slate-400 hover:text-emerald-500 py-2 border-b border-slate-100 dark:border-slate-900">
                02. Operations
            </a>
            <a href="#pricing" @click="open = false" class="font-mono-tech text-sm uppercase tracking-wider text-slate-600 dark:text-slate-400 hover:text-emerald-500 py-2 border-b border-slate-100 dark:border-slate-900">
                03. Pricing
            </a>
            <a href="#contact" @click="open = false" class="font-mono-tech text-sm uppercase tracking-wider text-slate-600 dark:text-slate-400 hover:text-emerald-500 py-2 border-b border-slate-100 dark:border-slate-900">
                04. Contact
            </a>

            <div class="flex items-center gap-4 mt-2 pt-2">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="w-full text-center font-mono-tech text-xs uppercase tracking-wider rounded-lg border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-slate-800 dark:text-slate-200">
                        [ Dashboard ]
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="w-1/2 text-center font-mono-tech text-xs uppercase tracking-wider border border-slate-200 dark:border-slate-800 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-400">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="w-1/2 text-center font-mono-tech text-xs uppercase tracking-wider bg-indigo-600 text-white px-4 py-3 rounded-lg font-bold shadow-md shadow-indigo-600/25">
                        Get Started
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>