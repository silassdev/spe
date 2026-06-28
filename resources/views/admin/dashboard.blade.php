<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-slate-500 font-mono-tech text-xs">+</span>
                <h2 class="font-mono-tech font-bold text-lg text-indigo-400 tracking-widest uppercase">
                    // ADMIN_CONTROL_PANEL
                </h2>
                <span class="text-slate-500 font-mono-tech text-xs">+</span>
            </div>
            <div class="font-mono-tech text-xs text-slate-500">
                {{ now()->format('Y-m-d H:i:s') }} UTC
            </div>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-screen-2xl mx-auto space-y-8">

        {{-- ╔══════════════════════════════════╗ --}}
        {{-- ║        KPI STATS GRID            ║ --}}
        {{-- ╚══════════════════════════════════╝ --}}
        <div class="relative">
            <div class="absolute -top-1 -left-1 text-slate-600 font-mono-tech text-xs select-none">+</div>
            <div class="absolute -top-1 -right-1 text-slate-600 font-mono-tech text-xs select-none">+</div>
            <div class="absolute -bottom-1 -left-1 text-slate-600 font-mono-tech text-xs select-none">+</div>
            <div class="absolute -bottom-1 -right-1 text-slate-600 font-mono-tech text-xs select-none">+</div>

            {{-- Gap-px grid technique --}}
            <div class="bg-slate-700/30 p-px rounded-lg">
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-px bg-slate-700/40">

                    {{-- Total Users --}}
                    <div class="bg-slate-900 p-5 flex flex-col gap-2 group hover:bg-slate-800/80 transition-colors">
                        <span class="font-mono-tech text-xs text-slate-500 tracking-widest">// TOTAL_USERS</span>
                        <span class="font-mono-tech text-3xl font-bold text-white">
                            {{ number_format($stats['total_users'] ?? 0) }}
                        </span>
                        <span class="font-mono-tech text-xs text-indigo-400">↑ registered accounts</span>
                    </div>

                    {{-- Active Users --}}
                    <div class="bg-slate-900 p-5 flex flex-col gap-2 group hover:bg-slate-800/80 transition-colors">
                        <span class="font-mono-tech text-xs text-slate-500 tracking-widest">// ACTIVE_USERS</span>
                        <span class="font-mono-tech text-3xl font-bold text-emerald-400">
                            {{ number_format($stats['active_users'] ?? 0) }}
                        </span>
                        <span class="font-mono-tech text-xs text-emerald-600">● status: online</span>
                    </div>

                    {{-- Pending Deposits --}}
                    <div class="bg-slate-900 p-5 flex flex-col gap-2 group hover:bg-slate-800/80 transition-colors {{ ($stats['pending_deposits'] ?? 0) > 0 ? 'ring-1 ring-amber-500/40' : '' }}">
                        <span class="font-mono-tech text-xs text-slate-500 tracking-widest">// PENDING_DEPOSITS</span>
                        <span class="font-mono-tech text-3xl font-bold {{ ($stats['pending_deposits'] ?? 0) > 0 ? 'text-amber-400' : 'text-white' }}">
                            {{ number_format($stats['pending_deposits'] ?? 0) }}
                        </span>
                        @if(($stats['pending_deposits'] ?? 0) > 0)
                            <span class="font-mono-tech text-xs text-amber-500 animate-pulse">⚠ awaiting review</span>
                        @else
                            <span class="font-mono-tech text-xs text-slate-600">— no pending</span>
                        @endif
                    </div>

                    {{-- Total Revenue --}}
                    <div class="bg-slate-900 p-5 flex flex-col gap-2 group hover:bg-slate-800/80 transition-colors">
                        <span class="font-mono-tech text-xs text-slate-500 tracking-widest">// TOTAL_REVENUE</span>
                        <span class="font-mono-tech text-3xl font-bold text-indigo-400">
                            ${{ number_format($stats['total_revenue'] ?? 0, 2) }}
                        </span>
                        <span class="font-mono-tech text-xs text-indigo-600">USD accumulated</span>
                    </div>

                    {{-- Active Investments --}}
                    <div class="bg-slate-900 p-5 flex flex-col gap-2 group hover:bg-slate-800/80 transition-colors">
                        <span class="font-mono-tech text-xs text-slate-500 tracking-widest">// ACTIVE_INVESTMENTS</span>
                        <span class="font-mono-tech text-3xl font-bold text-purple-400">
                            {{ number_format($stats['active_investments'] ?? 0) }}
                        </span>
                        <span class="font-mono-tech text-xs text-purple-600">running plans</span>
                    </div>

                    {{-- Total Withdrawals --}}
                    <div class="bg-slate-900 p-5 flex flex-col gap-2 group hover:bg-slate-800/80 transition-colors">
                        <span class="font-mono-tech text-xs text-slate-500 tracking-widest">// TOTAL_WITHDRAWALS</span>
                        <span class="font-mono-tech text-3xl font-bold text-rose-400">
                            ${{ number_format($stats['total_withdrawals'] ?? 0, 2) }}
                        </span>
                        <span class="font-mono-tech text-xs text-rose-600">USD disbursed</span>
                    </div>

                    {{-- Membership Upgrades --}}
                    <div class="bg-slate-900 p-5 flex flex-col gap-2 group hover:bg-slate-800/80 transition-colors">
                        <span class="font-mono-tech text-xs text-slate-500 tracking-widest">// MEMBERSHIP_UPGRADES</span>
                        <span class="font-mono-tech text-3xl font-bold text-cyan-400">
                            {{ number_format($stats['membership_upgrades'] ?? 0) }}
                        </span>
                        <span class="font-mono-tech text-xs text-cyan-600">tier promotions</span>
                    </div>

                    {{-- Daily Signups --}}
                    <div class="bg-slate-900 p-5 flex flex-col gap-2 group hover:bg-slate-800/80 transition-colors">
                        <span class="font-mono-tech text-xs text-slate-500 tracking-widest">// DAILY_SIGNUPS</span>
                        <span class="font-mono-tech text-3xl font-bold text-teal-400">
                            {{ number_format($stats['daily_signups'] ?? 0) }}
                        </span>
                        <span class="font-mono-tech text-xs text-teal-600">registered today</span>
                    </div>

                </div>
            </div>
        </div>

        {{-- ╔══════════════════════════════════╗ --}}
        {{-- ║   ACTIVITY LOG  |  TRADINGVIEW   ║ --}}
        {{-- ╚══════════════════════════════════╝ --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Activity Log Terminal --}}
            <div class="relative bg-slate-900 border border-slate-700/60 rounded-lg overflow-hidden">
                <div class="absolute -top-1 -left-1 text-slate-600 font-mono-tech text-xs select-none">+</div>
                <div class="absolute -top-1 -right-1 text-slate-600 font-mono-tech text-xs select-none">+</div>

                {{-- Terminal Header --}}
                <div class="flex items-center justify-between px-4 py-3 bg-slate-800/70 border-b border-slate-700/60">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                    </div>
                    <span class="font-mono-tech text-xs text-slate-400 tracking-widest">// ACTIVITY_LOG</span>
                    <span class="font-mono-tech text-xs text-slate-600">admin@cryptocore</span>
                </div>

                {{-- Terminal Body --}}
                <div class="p-4 font-mono-tech text-xs space-y-2 overflow-y-auto" style="height: 360px;">
                    <div class="flex gap-3">
                        <span class="text-slate-600 shrink-0">{{ now()->subMinutes(2)->format('H:i:s') }}</span>
                        <span class="text-emerald-400">[APPROVE]</span>
                        <span class="text-slate-300">Deposit #1042 approved — user: <span class="text-indigo-400">john_doe</span> — $250.00 USDT</span>
                    </div>
                    <div class="flex gap-3">
                        <span class="text-slate-600 shrink-0">{{ now()->subMinutes(5)->format('H:i:s') }}</span>
                        <span class="text-rose-400">[REJECT]</span>
                        <span class="text-slate-300">Withdrawal #891 rejected — user: <span class="text-indigo-400">alice_k</span> — $500.00</span>
                    </div>
                    <div class="flex gap-3">
                        <span class="text-slate-600 shrink-0">{{ now()->subMinutes(11)->format('H:i:s') }}</span>
                        <span class="text-purple-400">[UPGRADE]</span>
                        <span class="text-slate-300">Membership upgraded — user: <span class="text-indigo-400">bob_crypto</span> → GOLD tier</span>
                    </div>
                    <div class="flex gap-3">
                        <span class="text-slate-600 shrink-0">{{ now()->subMinutes(18)->format('H:i:s') }}</span>
                        <span class="text-cyan-400">[SIGNUP]</span>
                        <span class="text-slate-300">New user registered: <span class="text-indigo-400">sara_m</span> — via referral</span>
                    </div>
                    <div class="flex gap-3">
                        <span class="text-slate-600 shrink-0">{{ now()->subMinutes(25)->format('H:i:s') }}</span>
                        <span class="text-emerald-400">[APPROVE]</span>
                        <span class="text-slate-300">Deposit #1039 approved — user: <span class="text-indigo-400">mike_t</span> — $1200.00 BTC</span>
                    </div>
                    <div class="flex gap-3">
                        <span class="text-slate-600 shrink-0">{{ now()->subMinutes(32)->format('H:i:s') }}</span>
                        <span class="text-amber-400">[PIN_RESET]</span>
                        <span class="text-slate-300">PIN reset for user: <span class="text-indigo-400">lena_x</span></span>
                    </div>
                    <div class="flex gap-3">
                        <span class="text-slate-600 shrink-0">{{ now()->subMinutes(41)->format('H:i:s') }}</span>
                        <span class="text-rose-400">[REJECT]</span>
                        <span class="text-slate-300">Deposit #1035 rejected — invalid proof image</span>
                    </div>
                    <div class="flex gap-3">
                        <span class="text-slate-600 shrink-0">{{ now()->subMinutes(55)->format('H:i:s') }}</span>
                        <span class="text-purple-400">[SETTINGS]</span>
                        <span class="text-slate-300">Site settings updated — referral rate set to <span class="text-indigo-400">5%</span></span>
                    </div>
                    <div class="flex gap-3">
                        <span class="text-slate-600 shrink-0">{{ now()->subHour()->format('H:i:s') }}</span>
                        <span class="text-cyan-400">[SUPPORT]</span>
                        <span class="text-slate-300">Ticket #22 replied — user: <span class="text-indigo-400">omar_r</span></span>
                    </div>
                    <div class="flex gap-3">
                        <span class="text-slate-600 shrink-0">{{ now()->subHours(2)->format('H:i:s') }}</span>
                        <span class="text-emerald-400">[APPROVE]</span>
                        <span class="text-slate-300">Withdrawal #870 processed — $750.00 ETH</span>
                    </div>

                    {{-- Blinking cursor --}}
                    <div class="flex gap-3 mt-2">
                        <span class="text-slate-600 shrink-0">{{ now()->format('H:i:s') }}</span>
                        <span class="text-indigo-400 animate-pulse">▋</span>
                    </div>
                </div>
            </div>

            {{-- TradingView Widget --}}
            <div class="relative bg-slate-900 border border-slate-700/60 rounded-lg overflow-hidden">
                <div class="absolute -top-1 -left-1 text-slate-600 font-mono-tech text-xs select-none">+</div>
                <div class="absolute -top-1 -right-1 text-slate-600 font-mono-tech text-xs select-none">+</div>

                <div class="flex items-center justify-between px-4 py-3 bg-slate-800/70 border-b border-slate-700/60">
                    <span class="font-mono-tech text-xs text-slate-400 tracking-widest">// MARKET_FEED</span>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="font-mono-tech text-xs text-emerald-400">LIVE</span>
                    </div>
                </div>

                <div id="tradingview_admin" style="height: 400px;">
                    <div class="tradingview-widget-container" style="height: 100%; width: 100%;">
                        <div class="tradingview-widget-container__widget" style="height: calc(100% - 32px); width: 100%;"></div>
                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
                        {
                            "autosize": true,
                            "symbol": "BINANCE:BTCUSDT",
                            "interval": "60",
                            "timezone": "Etc/UTC",
                            "theme": "dark",
                            "style": "1",
                            "locale": "en",
                            "backgroundColor": "rgba(15, 23, 42, 1)",
                            "gridColor": "rgba(71, 85, 105, 0.2)",
                            "hide_top_toolbar": false,
                            "hide_legend": false,
                            "save_image": false,
                            "calendar": false,
                            "hide_volume": false,
                            "support_host": "https://www.tradingview.com"
                        }
                        </script>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
