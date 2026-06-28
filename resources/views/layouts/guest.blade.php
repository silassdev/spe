<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CryptoCore') }} | Secure Gateway</title>

        <!-- Fonts: Outfit (Sans) and JetBrains Mono (Tech HUD) -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700;800&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Inline script to prevent theme flickering on page load -->
        <script>
            if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Outfit', sans-serif;
            }
            .font-mono-tech {
                font-family: 'JetBrains Mono', monospace;
            }
        </style>
    </head>
    <body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased transition-colors duration-300 min-h-screen flex flex-col relative">
        
        <!-- Reusable Connected Tiny Squares Mesh Background -->
        <x-tech-squares />

        <!-- Floating Home Node button on top left -->
        <div class="absolute top-6 left-6 z-50">
            <a href="/" class="flex items-center gap-2 group font-mono-tech text-xs uppercase tracking-wider text-slate-600 dark:text-slate-400 hover:text-indigo-500 transition duration-200">
                <span>&larr; [ BACK_TO_HOME ]</span>
            </a>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10">
            <!-- Brand Logo -->
            <div class="mb-6">
                <a href="/" class="flex flex-col items-center gap-2 group">
                    <div class="relative flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-600 to-purple-600 font-black text-white shadow-lg shadow-indigo-600/20 transition-all duration-300 group-hover:scale-105 font-mono-tech">
                        C
                        <div class="absolute top-0.5 left-0.5 w-1 h-1 bg-white/40 rounded-full"></div>
                    </div>
                    <span class="font-bold text-base tracking-tight text-slate-900 dark:text-white">CryptoCore</span>
                    <span class="font-mono-tech text-xs uppercase tracking-widest text-slate-400 dark:text-slate-500">// AUTH_GATEWAY_NODE</span>
                </a>
            </div>

            <!-- Login / Register Card (Technical Grid themed) -->
            <div class="w-full sm:max-w-md px-8 py-8 bg-white/80 dark:bg-slate-900/80 backdrop-blur border border-slate-200 dark:border-slate-800/80 shadow-xl sm:rounded-2xl relative overflow-hidden">
                <!-- Grid decor plus markers -->
                <div class="absolute top-1.5 left-1.5 text-slate-300 dark:text-slate-700 font-mono text-[9px] select-none pointer-events-none">+</div>
                <div class="absolute bottom-1.5 right-1.5 text-slate-300 dark:text-slate-700 font-mono text-[9px] select-none pointer-events-none">+</div>

                {{ $slot }}
            </div>
        </div>

        <!-- Global Overlapping Dots Loader -->
        <x-overlapping-dots type="global" text="Syncing Auth Gateway..." />

        <!-- Simple and premium loader trigger script -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const loader = document.getElementById('global-loader');
                
                // Show loader on page transition and fade out
                loader.classList.add('active');
                setTimeout(() => {
                    loader.classList.remove('active');
                }, 450);

                // Show loader when any form is submitted
                document.querySelectorAll('form').forEach(form => {
                    form.addEventListener('submit', () => {
                        loader.classList.add('active');
                    });
                });

                // Show loader when Google redirect is clicked
                document.querySelectorAll('a[href*="auth/google"]').forEach(btn => {
                    btn.addEventListener('click', () => {
                        loader.classList.add('active');
                    });
                });
            });
        </script>
    </body>
</html>
