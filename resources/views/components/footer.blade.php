<footer
    id="contact"
    class="relative border-t border-slate-200 dark:border-slate-800/60 bg-white dark:bg-slate-950 transition-colors duration-300 py-16"
>
    <!-- Border Grid Decoration Plus Signs -->
    <div class="absolute -top-1.5 -left-1.5 z-10 text-slate-400 dark:text-slate-600 font-mono text-xs select-none pointer-events-none">+</div>
    <div class="absolute -top-1.5 -right-1.5 z-10 text-slate-400 dark:text-slate-600 font-mono text-xs select-none pointer-events-none">+</div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 border-l border-r border-slate-200/60 dark:border-slate-800/40">
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 pb-12 border-b border-slate-200 dark:border-slate-800/60">
            <!-- Brand Column -->
            <div class="md:col-span-2 space-y-4">
                <a href="/" class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-500 font-black text-white shadow-md shadow-emerald-500/20">
                        H
                    </div>
                    <div>
                        <div class="font-bold text-lg text-slate-900 dark:text-white">Hausify</div>
                        <div class="text-xs font-mono-tech uppercase tracking-widest text-slate-400 dark:text-slate-500">PROP // LOGISTICS</div>
                    </div>
                </a>
                <p class="text-sm leading-relaxed text-slate-500 dark:text-slate-400 max-w-sm">
                    Automating rent collection, tenant onboarding, and maintenance coordination in a clean, high-performance technical grid platform.
                </p>
                <div class="flex gap-2">
                    <span class="inline-flex items-center rounded-full bg-emerald-50 dark:bg-emerald-950/40 px-2.5 py-0.5 text-xs font-medium text-emerald-600 dark:text-emerald-400 ring-1 ring-inset ring-emerald-500/20">
                        <span class="mr-1.5 flex h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        ALL_SYS_OPERATIONAL
                    </span>
                </div>
            </div>

            <!-- Sitemap 1 -->
            <div>
                <h4 class="font-mono-tech text-xs uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-4">// System Nav</h4>
                <ul class="space-y-2.5 text-sm">
                    <li>
                        <a href="#features" class="text-slate-600 dark:text-slate-400 hover:text-emerald-500 dark:hover:text-emerald-400 transition-colors">
                            01. System Features
                        </a>
                    </li>
                    <li>
                        <a href="#how-it-works" class="text-slate-600 dark:text-slate-400 hover:text-emerald-500 dark:hover:text-emerald-400 transition-colors">
                            02. Operations Flow
                        </a>
                    </li>
                    <li>
                        <a href="#pricing" class="text-slate-600 dark:text-slate-400 hover:text-emerald-500 dark:hover:text-emerald-400 transition-colors">
                            03. Subscription Plans
                        </a>
                    </li>
                    <li>
                        <a href="#contact" class="text-slate-600 dark:text-slate-400 hover:text-emerald-500 dark:hover:text-emerald-400 transition-colors">
                            04. Direct Contact
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Sitemap 2 -->
            <div>
                <h4 class="font-mono-tech text-xs uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-4">// Developers</h4>
                <ul class="space-y-2.5 text-sm">
                    <li>
                        <a href="{{ route('login') }}" class="text-slate-600 dark:text-slate-400 hover:text-emerald-500 dark:hover:text-emerald-400 transition-colors">
                            Portal Login
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="text-slate-600 dark:text-slate-400 hover:text-emerald-500 dark:hover:text-emerald-400 transition-colors">
                            Instance Registry
                        </a>
                    </li>
                    <li>
                        <a href="mailto:hello@hausifyapp.com" class="text-slate-600 dark:text-slate-400 hover:text-emerald-500 dark:hover:text-emerald-400 transition-colors">
                            Sysops Support
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Technical Metadata Row -->
        <div class="flex flex-col md:flex-row justify-between items-center pt-8 gap-4 text-xs font-mono-tech text-slate-400 dark:text-slate-500">
            <div>
                &copy; {{ date('Y') }} HAUSIFY_CORE. ALL RIGHTS RESERVED. [LIC_3392-A]
            </div>
            <div class="flex items-center gap-6">
                <span>LOC: [{{ str_replace('_', '-', app()->getLocale()) }}]</span>
                <span>PING: [0.034ms]</span>
                <span>DB_SYNC: [OK]</span>
            </div>
        </div>

    </div>
</footer>