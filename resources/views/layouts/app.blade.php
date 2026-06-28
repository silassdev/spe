<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CryptoCore') }} - Dashboard</title>

        <!-- Fonts: Outfit and JetBrains Mono -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700;800&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Inline script to prevent theme flickering -->
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
    <body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased transition-colors duration-300">
        
        @php
            $user = auth()->user();
            $role = $user?->role ?? 'user';
            
            // Core theme configurations mapping role to class keys
            $themes = [
                'admin' => [
                    'name' => 'Admin Control Panel',
                    'color' => 'rose',
                    'text' => 'text-rose-500',
                    'bg' => 'bg-rose-500',
                    'bgLight' => 'bg-rose-500/10 dark:bg-rose-500/5',
                    'border' => 'border-rose-500/30 dark:border-rose-500/20',
                    'borderHover' => 'hover:border-rose-500/50',
                    'activeNav' => 'bg-rose-500/10 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 border-rose-500',
                    'badge' => 'bg-rose-500/10 text-rose-600 dark:text-rose-400 border-rose-500/20',
                ],
                'user' => [
                    'name' => 'User Workspace',
                    'color' => 'indigo',
                    'text' => 'text-indigo-500',
                    'bg' => 'bg-indigo-500',
                    'bgLight' => 'bg-indigo-500/10 dark:bg-indigo-500/5',
                    'border' => 'border-indigo-500/30 dark:border-indigo-500/20',
                    'borderHover' => 'hover:border-indigo-500/50',
                    'activeNav' => 'bg-indigo-500/10 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border-indigo-500',
                    'badge' => 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border-indigo-500/20',
                ]
            ];
            
            $theme = $themes[$role] ?? $themes['user'];
        @endphp

        <!-- Connected Tiny Squares Mesh Background (Only top header glow for dashboards) -->
        <div class="absolute inset-x-0 top-0 h-[250px] pointer-events-none z-0 overflow-hidden">
            <div class="w-full h-full bg-tech-squares-light dark:bg-tech-squares-dark [mask-image:linear-gradient(to_bottom,black_20%,transparent_100%)] [-webkit-mask-image:linear-gradient(to_bottom,black_20%,transparent_100%)] opacity-30"></div>
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[150px] {{ $theme['bgLight'] }} blur-[80px] rounded-full"></div>
        </div>

        <div x-data="{ sidebarOpen: false, sidebarCollapsed: false, dark: false }"
             x-init="dark = document.documentElement.classList.contains('dark')"
             class="min-h-screen flex relative z-10">
            
            <!-- Mobile Sidebar Overlay -->
            <div x-show="sidebarOpen" 
                 @click="sidebarOpen = false" 
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 lg:hidden" 
                 style="display: none;">
            </div>

            <!-- SIDEBAR -->
            <aside :class="{
                        'translate-x-0': sidebarOpen,
                        '-translate-x-full': !sidebarOpen,
                        'lg:w-64': !sidebarCollapsed,
                        'lg:w-20': sidebarCollapsed
                    }"
                   class="fixed inset-y-0 left-0 w-64 lg:static lg:translate-x-0 z-50 bg-white/95 dark:bg-slate-900/90 backdrop-blur border-r border-slate-200 dark:border-slate-800/80 flex flex-col justify-between transition-all duration-300 transform">
                
                <div>
                    <!-- Sidebar Header / Logo -->
                    <div class="h-16 flex items-center px-4 border-b border-slate-200 dark:border-slate-800 justify-between">
                        <a href="/" class="flex items-center gap-2 group overflow-hidden">
                            <div class="relative flex h-9 w-9 shrink-0 items-center justify-center rounded-lg {{ $theme['bg'] }} font-black text-white shadow transition-all duration-300 font-mono-tech">
                                C
                            </div>
                            <div class="transition-all duration-300" :class="{ 'opacity-0 w-0': sidebarCollapsed, 'opacity-100': !sidebarCollapsed }">
                                <span class="font-bold text-sm tracking-tight text-slate-900 dark:text-white block">CryptoCore</span>
                                <span class="text-[9px] font-mono-tech uppercase text-slate-400 dark:text-slate-500 block">DASHBOARD</span>
                            </div>
                        </a>
                        <!-- Tech decoration dot -->
                        <div class="w-1.5 h-1.5 rounded-full {{ $theme['bg'] }} animate-pulse" :class="{ 'hidden': sidebarCollapsed }"></div>
                    </div>

                    <!-- Role Badge / Workspace Selector -->
                    <div class="p-3 border-b border-slate-200 dark:border-slate-800" :class="{ 'text-center': sidebarCollapsed }">
                        <div :class="{ 'inline-block mx-auto': sidebarCollapsed, 'flex flex-col gap-1': !sidebarCollapsed }">
                            <span class="font-mono-tech text-[9px] text-slate-400 dark:text-slate-500 uppercase" :class="{ 'sr-only': sidebarCollapsed }">// ACTIVE_NODE</span>
                            <div class="px-2.5 py-1 text-xs font-bold font-mono-tech border rounded-lg uppercase tracking-wider {{ $theme['badge'] }} inline-block">
                                <span x-show="!sidebarCollapsed">{{ $theme['name'] }}</span>
                                <span x-show="sidebarCollapsed">{{ strtoupper(substr($role, 0, 2)) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Navigation Links -->
                    <nav class="p-4 space-y-1">
                        @if($role === 'admin')
                            <!-- Admin Navigation -->
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-semibold rounded-lg border transition {{ request()->routeIs('admin.dashboard') ? $theme['activeNav'] : 'border-transparent text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/40 hover:text-slate-900 dark:hover:text-white' }}">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                                <span :class="{ 'hidden': sidebarCollapsed }">Dashboard</span>
                            </a>
                            <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-semibold rounded-lg border transition {{ request()->routeIs('admin.users') ? $theme['activeNav'] : 'border-transparent text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/40 hover:text-slate-900 dark:hover:text-white' }}">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span :class="{ 'hidden': sidebarCollapsed }">Users</span>
                            </a>
                            <a href="{{ route('admin.deposits') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-semibold rounded-lg border transition {{ request()->routeIs('admin.deposits') ? $theme['activeNav'] : 'border-transparent text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/40 hover:text-slate-900 dark:hover:text-white' }}">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                                <span :class="{ 'hidden': sidebarCollapsed }">Deposits & Upgrades</span>
                            </a>
                            <a href="{{ route('admin.withdrawals') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-semibold rounded-lg border transition {{ request()->routeIs('admin.withdrawals') ? $theme['activeNav'] : 'border-transparent text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/40 hover:text-slate-900 dark:hover:text-white' }}">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span :class="{ 'hidden': sidebarCollapsed }">Withdrawals</span>
                            </a>
                            <a href="{{ route('admin.support') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-semibold rounded-lg border transition {{ request()->routeIs('admin.support') ? $theme['activeNav'] : 'border-transparent text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/40 hover:text-slate-900 dark:hover:text-white' }}">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span :class="{ 'hidden': sidebarCollapsed }">Support Tickets</span>
                            </a>
                            <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-semibold rounded-lg border transition {{ request()->routeIs('admin.settings') ? $theme['activeNav'] : 'border-transparent text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/40 hover:text-slate-900 dark:hover:text-white' }}">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span :class="{ 'hidden': sidebarCollapsed }">Site Settings</span>
                            </a>
                        @else
                            <!-- User Navigation -->
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-semibold rounded-lg border transition {{ request()->routeIs('dashboard') ? $theme['activeNav'] : 'border-transparent text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/40 hover:text-slate-900 dark:hover:text-white' }}">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                <span :class="{ 'hidden': sidebarCollapsed }">Dashboard</span>
                            </a>
                            <a href="{{ route('deposit') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-semibold rounded-lg border transition {{ request()->routeIs('deposit') ? $theme['activeNav'] : 'border-transparent text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/40 hover:text-slate-900 dark:hover:text-white' }}">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                <span :class="{ 'hidden': sidebarCollapsed }">Deposit</span>
                            </a>
                            <a href="{{ route('withdraw') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-semibold rounded-lg border transition {{ request()->routeIs('withdraw') ? $theme['activeNav'] : 'border-transparent text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/40 hover:text-slate-900 dark:hover:text-white' }}">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                <span :class="{ 'hidden': sidebarCollapsed }">Withdraw</span>
                            </a>
                            <a href="{{ route('invest') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-semibold rounded-lg border transition {{ request()->routeIs('invest') ? $theme['activeNav'] : 'border-transparent text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/40 hover:text-slate-900 dark:hover:text-white' }}">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                <span :class="{ 'hidden': sidebarCollapsed }">Investment Plans</span>
                            </a>
                            <a href="{{ route('membership') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-semibold rounded-lg border transition {{ request()->routeIs('membership') ? $theme['activeNav'] : 'border-transparent text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/40 hover:text-slate-900 dark:hover:text-white' }}">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                                <span :class="{ 'hidden': sidebarCollapsed }">Membership Upgrade</span>
                            </a>
                            <a href="{{ route('transactions') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-semibold rounded-lg border transition {{ request()->routeIs('transactions') ? $theme['activeNav'] : 'border-transparent text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/40 hover:text-slate-900 dark:hover:text-white' }}">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                                <span :class="{ 'hidden': sidebarCollapsed }">Transactions</span>
                            </a>
                            <a href="{{ route('referrals') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-semibold rounded-lg border transition {{ request()->routeIs('referrals') ? $theme['activeNav'] : 'border-transparent text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/40 hover:text-slate-900 dark:hover:text-white' }}">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 10.742l-1.42 2.839a1 1 0 00.93 1.419h9.614a1 1 0 00.903-1.428l-1.602-3.204a1 1 0 00-1.806 0L13.792 13h-3.585l1.477-2.953a1 1 0 00-.903-1.429H8.684a1 1 0 00-.903 1.429zm-4.5 9h16.5m-16.5-12h16.5"/></svg>
                                <span :class="{ 'hidden': sidebarCollapsed }">Referrals</span>
                            </a>
                            <a href="{{ route('support') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-semibold rounded-lg border transition {{ request()->routeIs('support') ? $theme['activeNav'] : 'border-transparent text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/40 hover:text-slate-900 dark:hover:text-white' }}">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                <span :class="{ 'hidden': sidebarCollapsed }">Support Ticket</span>
                            </a>
                        @endif

                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-semibold rounded-lg border transition {{ request()->routeIs('profile.edit') ? $theme['activeNav'] : 'border-transparent text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800/40 hover:text-slate-900 dark:hover:text-white' }}">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            <span :class="{ 'hidden': sidebarCollapsed }">Profile & Security</span>
                        </a>
                    </nav>
                </div>

                <!-- Sidebar Footer -->
                <div class="p-4 border-t border-slate-200 dark:border-slate-800 flex flex-col gap-2">
                    <div class="flex items-center gap-3" :class="{ 'justify-center': sidebarCollapsed }">
                        <div class="w-8 h-8 rounded-full bg-slate-200 dark:bg-slate-800 text-slate-700 dark:text-slate-300 font-bold flex items-center justify-center text-xs shrink-0 uppercase">
                            {{ substr($user?->username ?? 'U', 0, 2) }}
                        </div>
                        <div class="overflow-hidden" :class="{ 'hidden': sidebarCollapsed }">
                            <h4 class="text-xs font-bold text-slate-900 dark:text-white truncate">{{ $user?->name }}</h4>
                            <p class="text-[10px] text-slate-400 dark:text-slate-500 truncate">{{ $user?->email }}</p>
                        </div>
                    </div>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" 
                                class="w-full flex items-center gap-3 px-3 py-2 text-xs font-semibold font-mono-tech border border-transparent rounded-lg text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/20 transition"
                                :class="{ 'justify-center': sidebarCollapsed }">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            <span :class="{ 'hidden': sidebarCollapsed }">LOGOUT</span>
                        </button>
                    </form>
                </div>
            </aside>

            <!-- MAIN WORKSPACE CONTENT CONTAINER -->
            <div class="flex-1 flex flex-col min-w-0 min-h-screen">
                
                <!-- TOP HEADER BAR -->
                <header class="h-16 bg-white/95 dark:bg-slate-900/90 backdrop-blur border-b border-slate-200 dark:border-slate-800/80 px-4 sm:px-6 flex items-center justify-between sticky top-0 z-30">
                    
                    <!-- Left actions (Sidebar Toggle) -->
                    <div class="flex items-center gap-4">
                        <!-- Desktop Sidebar Toggle -->
                        <button @click="sidebarCollapsed = !sidebarCollapsed" 
                                class="hidden lg:flex p-1.5 rounded-lg border border-slate-200 dark:border-slate-800 text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800 transition"
                                aria-label="Toggle Sidebar">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                            </svg>
                        </button>

                        <!-- Mobile Sidebar Toggle -->
                        <button @click="sidebarOpen = !sidebarOpen" 
                                class="lg:hidden p-1.5 rounded-lg border border-slate-200 dark:border-slate-800 text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800 transition"
                                aria-label="Toggle Menu">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>

                        <!-- Header Page Title -->
                        @isset($header)
                            {{ $header }}
                        @else
                            <h2 class="font-bold text-slate-900 dark:text-white text-base">Dashboard Overview</h2>
                        @endisset
                    </div>

                    <!-- Right actions (Theme Toggle, Info) -->
                    <div class="flex items-center gap-3">
                        
                        <!-- Theme Toggle -->
                        <button @click="
                                    dark = !dark; 
                                    if(dark) { 
                                        document.documentElement.classList.add('dark'); 
                                        localStorage.setItem('theme', 'dark'); 
                                    } else { 
                                        document.documentElement.classList.remove('dark'); 
                                        localStorage.setItem('theme', 'light'); 
                                    }
                                "
                                class="p-2 rounded-lg border border-slate-200 dark:border-slate-800 text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800 transition"
                                aria-label="Toggle Theme">
                            <svg x-show="dark" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                            </svg>
                            <svg x-show="!dark" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                        </button>

                        <div class="h-6 w-[1px] bg-slate-200 dark:bg-slate-800"></div>

                        <!-- User Profile Info -->
                        <span class="text-xs font-mono-tech uppercase tracking-wider text-slate-500 bg-slate-100 dark:bg-slate-800/60 border border-slate-200 dark:border-slate-800 px-2.5 py-1 rounded">
                            {{ $role }} // online
                        </span>
                    </div>
                </header>

                <!-- PAGE MAIN CONTAINER -->
                <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-y-auto relative z-10">
                    
                    @if (session('status') == 'pin-updated')
                        <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 rounded-lg text-xs font-mono-tech select-none">
                            // SEC_STATUS: Security PIN successfully redefined. Active nodes synchronized.
                        </div>
                    @endif

                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>