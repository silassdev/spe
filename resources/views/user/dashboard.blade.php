<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <span class="font-mono-tech text-[10px] text-indigo-500 uppercase tracking-wider bg-indigo-500/10 border border-indigo-500/20 px-2 py-0.5 rounded">// OVERVIEW</span>
            <h2 class="font-bold text-slate-900 dark:text-white text-base">Dashboard</h2>
        </div>
    </x-slot>

    @php
        $tierColors = [
            'Bronze'   => ['text' => 'text-amber-600',  'bg' => 'bg-amber-600/10',  'border' => 'border-amber-600/20'],
            'Silver'   => ['text' => 'text-slate-400',  'bg' => 'bg-slate-400/10',  'border' => 'border-slate-400/20'],
            'Gold'     => ['text' => 'text-yellow-500', 'bg' => 'bg-yellow-500/10', 'border' => 'border-yellow-500/20'],
            'Platinum' => ['text' => 'text-cyan-400',   'bg' => 'bg-cyan-400/10',   'border' => 'border-cyan-400/20'],
            'Diamond'  => ['text' => 'text-indigo-400', 'bg' => 'bg-indigo-400/10', 'border' => 'border-indigo-400/20'],
        ];
        $tierName = $user->tier?->name ?? 'Unranked';
        $tc = $tierColors[$tierName] ?? ['text' => 'text-slate-400', 'bg' => 'bg-slate-400/10', 'border' => 'border-slate-400/20'];
    @endphp

    <div class="space-y-6">

        {{-- TOP KPI METRIC CARDS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-px bg-slate-200 dark:bg-slate-800/60 rounded-xl overflow-hidden shadow-sm">

            {{-- Wallet Balance --}}
            <div class="bg-white dark:bg-slate-950 p-5 relative group hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition">
                <div class="absolute top-2 left-2 text-[9px] text-slate-300 dark:text-slate-800 font-mono select-none">+</div>
                <div class="flex items-center justify-between mb-3">
                    <span class="font-mono-tech text-[10px] uppercase text-slate-400 dark:text-slate-500">// WALLET_BAL</span>
                    <div class="w-8 h-8 rounded-lg bg-indigo-500/10 flex items-center justify-center">
                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                    </div>
                </div>
                <div class="text-2xl font-black font-mono-tech text-slate-900 dark:text-white">${{ number_format($user->wallet_balance, 2) }}</div>
                <div class="text-xs text-slate-400 dark:text-slate-500 mt-1">Available for withdrawal</div>
            </div>

            {{-- Membership Level --}}
            <div class="bg-white dark:bg-slate-950 p-5 relative group hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition">
                <div class="absolute top-2 left-2 text-[9px] text-slate-300 dark:text-slate-800 font-mono select-none">+</div>
                <div class="flex items-center justify-between mb-3">
                    <span class="font-mono-tech text-[10px] uppercase text-slate-400 dark:text-slate-500">// MEMBERSHIP</span>
                    <span class="font-mono-tech text-[10px] px-2 py-0.5 rounded border {{ $tc['text'] }} {{ $tc['bg'] }} {{ $tc['border'] }}">{{ strtoupper($tierName) }}</span>
                </div>
                <div class="text-2xl font-black font-mono-tech text-slate-900 dark:text-white">{{ $tierName }}</div>
                <div class="text-xs text-slate-400 dark:text-slate-500 mt-1">
                    @if($user->tier)
                        {{ $user->tier->daily_roi }}% daily ROI &bull; {{ $user->tier->duration }} days
                    @else
                        No active membership
                    @endif
                </div>
            </div>

            {{-- Portfolio Value --}}
            <div class="bg-white dark:bg-slate-950 p-5 relative group hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition">
                <div class="absolute top-2 left-2 text-[9px] text-slate-300 dark:text-slate-800 font-mono select-none">+</div>
                <div class="flex items-center justify-between mb-3">
                    <span class="font-mono-tech text-[10px] uppercase text-slate-400 dark:text-slate-500">// PORTFOLIO_VAL</span>
                    <div class="w-8 h-8 rounded-lg bg-emerald-500/10 flex items-center justify-center">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                </div>
                <div class="text-2xl font-black font-mono-tech text-slate-900 dark:text-white">${{ number_format($portfolioValue, 2) }}</div>
                <div class="text-xs text-slate-400 dark:text-slate-500 mt-1">Active investment principal</div>
            </div>

            {{-- Referral Earnings --}}
            <div class="bg-white dark:bg-slate-950 p-5 relative group hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition">
                <div class="absolute top-2 left-2 text-[9px] text-slate-300 dark:text-slate-800 font-mono select-none">+</div>
                <div class="flex items-center justify-between mb-3">
                    <span class="font-mono-tech text-[10px] uppercase text-slate-400 dark:text-slate-500">// REFERRAL_EARN</span>
                    <div class="w-8 h-8 rounded-lg bg-purple-500/10 flex items-center justify-center">
                        <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                </div>
                <div class="text-2xl font-black font-mono-tech text-slate-900 dark:text-white">${{ number_format($referralEarnings, 2) }}</div>
                <div class="text-xs text-slate-400 dark:text-slate-500 mt-1">Total referral commissions</div>
            </div>
        </div>

        {{-- MIDDLE ROW: Live Prices + Investments --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            {{-- Live Crypto Prices --}}
            <div class="lg:col-span-5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 p-5 relative"
                 x-data="{
                    prices: {
                        BTC:  { p: 67240.50, c: 0.12 },
                        ETH:  { p: 3482.20,  c: -0.05 },
                        SOL:  { p: 142.80,   c: 1.45 },
                        BNB:  { p: 585.10,   c: 0.32 },
                        DOGE: { p: 0.1245,   c: -1.25 },
                        ADA:  { p: 0.3842,   c: 0.05 },
                        XRP:  { p: 0.4950,   c: 0.00 }
                    },
                    init() {
                        setInterval(() => {
                            Object.keys(this.prices).forEach(k => {
                                let d = (Math.random()-0.5)*(this.prices[k].p*0.003);
                                this.prices[k].p = parseFloat((this.prices[k].p+d).toFixed(['DOGE','ADA','XRP'].includes(k)?4:2));
                                this.prices[k].c = parseFloat(((Math.random()-0.5)*4).toFixed(2));
                            });
                        }, 3000);
                    }
                 }"
            >
                <div class="absolute top-2 left-2 text-[9px] text-slate-300 dark:text-slate-800 font-mono select-none">+</div>
                <div class="absolute bottom-2 right-2 text-[9px] text-slate-300 dark:text-slate-800 font-mono select-none">+</div>
                <div class="flex items-center justify-between mb-4">
                    <span class="font-mono-tech text-[10px] uppercase text-slate-400 dark:text-slate-500">// LIVE_COIN_PRICES</span>
                    <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                </div>
                <div class="space-y-2">
                    <template x-for="(coin, key) in prices" :key="key">
                        <div class="flex justify-between items-center py-1.5 border-b border-slate-100 dark:border-slate-900 last:border-0">
                            <div class="flex items-center gap-2">
                                <span class="font-mono-tech text-xs font-bold text-slate-900 dark:text-white w-10" x-text="key"></span>
                                <span class="text-[9px] font-mono-tech text-slate-400">/ USDT</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="font-mono-tech text-xs text-slate-700 dark:text-slate-300" x-text="'$' + coin.p.toLocaleString()"></span>
                                <span :class="coin.c >= 0 ? 'text-emerald-500 bg-emerald-500/10' : 'text-rose-500 bg-rose-500/10'" class="font-mono-tech text-[10px] px-1.5 py-0.5 rounded font-bold" x-text="(coin.c >= 0 ? '+' : '') + coin.c + '%'"></span>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Active Investments --}}
            <div class="lg:col-span-7 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 p-5 relative">
                <div class="absolute top-2 left-2 text-[9px] text-slate-300 dark:text-slate-800 font-mono select-none">+</div>
                <div class="absolute bottom-2 right-2 text-[9px] text-slate-300 dark:text-slate-800 font-mono select-none">+</div>
                <div class="flex items-center justify-between mb-4">
                    <span class="font-mono-tech text-[10px] uppercase text-slate-400 dark:text-slate-500">// CURRENT_INVESTMENTS</span>
                    <a href="{{ route('invest') }}" class="font-mono-tech text-[10px] text-indigo-500 hover:text-indigo-400 uppercase">[ VIEW_ALL ]</a>
                </div>
                @forelse($currentInvestments as $inv)
                    <div class="rounded-lg border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 p-4 mb-3 last:mb-0">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-bold text-sm text-slate-900 dark:text-white">{{ $inv->tier->name }} Plan</span>
                            <span class="font-mono-tech text-[10px] px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-500 border border-emerald-500/20">ACTIVE</span>
                        </div>
                        <div class="grid grid-cols-3 gap-3 font-mono-tech text-xs">
                            <div>
                                <div class="text-slate-400 text-[9px] uppercase">// Principal</div>
                                <div class="font-bold text-slate-800 dark:text-white">${{ number_format($inv->amount, 2) }}</div>
                            </div>
                            <div>
                                <div class="text-slate-400 text-[9px] uppercase">// Profit So Far</div>
                                <div class="font-bold text-emerald-500">${{ number_format($inv->profit, 2) }}</div>
                            </div>
                            <div>
                                <div class="text-slate-400 text-[9px] uppercase">// Expires</div>
                                <div class="font-bold text-slate-800 dark:text-white">{{ $inv->expires_at->format('M d, Y') }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-slate-400 dark:text-slate-600 font-mono-tech text-xs">
                        // NO_ACTIVE_PLANS<br>
                        <a href="{{ route('invest') }}" class="text-indigo-500 hover:underline mt-2 inline-block">[ ACTIVATE_PLAN ]</a>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- BOTTOM ROW: Recent Activity + Announcements + Quick Actions --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            {{-- Recent Deposits --}}
            <div class="lg:col-span-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 p-5">
                <div class="flex items-center justify-between mb-4">
                    <span class="font-mono-tech text-[10px] uppercase text-slate-400 dark:text-slate-500">// RECENT_DEPOSITS</span>
                    <a href="{{ route('deposit') }}" class="font-mono-tech text-[10px] text-indigo-500 hover:text-indigo-400 uppercase">[ +NEW ]</a>
                </div>
                <div class="space-y-2">
                    @forelse($recentDeposits as $dep)
                        <div class="flex justify-between items-center py-2 border-b border-slate-100 dark:border-slate-900 last:border-0">
                            <div>
                                <div class="text-xs font-bold text-slate-800 dark:text-white font-mono-tech">${{ number_format($dep->amount, 2) }} {{ $dep->currency }}</div>
                                <div class="text-[10px] text-slate-400 font-mono-tech">{{ $dep->created_at->format('M d, H:i') }}</div>
                            </div>
                            @php $s = $dep->status; @endphp
                            <span class="font-mono-tech text-[9px] px-2 py-0.5 rounded border
                                {{ $s === 'confirmed' ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : ($s === 'pending' ? 'bg-amber-500/10 text-amber-500 border-amber-500/20' : 'bg-rose-500/10 text-rose-500 border-rose-500/20') }}">
                                {{ strtoupper($s) }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-6 text-slate-400 font-mono-tech text-[10px]">// NO_DEPOSITS_YET</div>
                    @endforelse
                </div>
            </div>

            {{-- Recent Withdrawals --}}
            <div class="lg:col-span-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 p-5">
                <div class="flex items-center justify-between mb-4">
                    <span class="font-mono-tech text-[10px] uppercase text-slate-400 dark:text-slate-500">// RECENT_WITHDRAWALS</span>
                    <a href="{{ route('withdraw') }}" class="font-mono-tech text-[10px] text-indigo-500 hover:text-indigo-400 uppercase">[ REQUEST ]</a>
                </div>
                <div class="space-y-2">
                    @forelse($recentWithdrawals as $wd)
                        <div class="flex justify-between items-center py-2 border-b border-slate-100 dark:border-slate-900 last:border-0">
                            <div>
                                <div class="text-xs font-bold text-slate-800 dark:text-white font-mono-tech">${{ number_format($wd->amount, 2) }}</div>
                                <div class="text-[10px] text-slate-400 font-mono-tech">{{ $wd->created_at->format('M d, H:i') }}</div>
                            </div>
                            @php $s = $wd->status; @endphp
                            <span class="font-mono-tech text-[9px] px-2 py-0.5 rounded border
                                {{ $s === 'approved' ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : ($s === 'pending' ? 'bg-amber-500/10 text-amber-500 border-amber-500/20' : 'bg-rose-500/10 text-rose-500 border-rose-500/20') }}">
                                {{ strtoupper($s) }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-6 text-slate-400 font-mono-tech text-[10px]">// NO_WITHDRAWALS_YET</div>
                    @endforelse
                </div>
            </div>

            {{-- Announcements + Quick Actions --}}
            <div class="lg:col-span-4 space-y-4">
                {{-- Quick Actions Grid --}}
                <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 p-5">
                    <div class="font-mono-tech text-[10px] uppercase text-slate-400 dark:text-slate-500 mb-3">// QUICK_ACTIONS</div>
                    <div class="grid grid-cols-2 gap-2">
                        <a href="{{ route('deposit') }}" class="flex flex-col items-center justify-center p-3 rounded-lg border border-slate-200 dark:border-slate-800 hover:border-indigo-500/50 hover:bg-indigo-500/5 transition group text-center">
                            <svg class="w-5 h-5 text-indigo-500 mb-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            <span class="font-mono-tech text-[10px] uppercase text-slate-600 dark:text-slate-400 group-hover:text-indigo-500">Deposit</span>
                        </a>
                        <a href="{{ route('withdraw') }}" class="flex flex-col items-center justify-center p-3 rounded-lg border border-slate-200 dark:border-slate-800 hover:border-rose-500/50 hover:bg-rose-500/5 transition group text-center">
                            <svg class="w-5 h-5 text-rose-500 mb-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                            <span class="font-mono-tech text-[10px] uppercase text-slate-600 dark:text-slate-400 group-hover:text-rose-500">Withdraw</span>
                        </a>
                        <a href="{{ route('invest') }}" class="flex flex-col items-center justify-center p-3 rounded-lg border border-slate-200 dark:border-slate-800 hover:border-emerald-500/50 hover:bg-emerald-500/5 transition group text-center">
                            <svg class="w-5 h-5 text-emerald-500 mb-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                            <span class="font-mono-tech text-[10px] uppercase text-slate-600 dark:text-slate-400 group-hover:text-emerald-500">Invest</span>
                        </a>
                        <a href="{{ route('membership') }}" class="flex flex-col items-center justify-center p-3 rounded-lg border border-slate-200 dark:border-slate-800 hover:border-purple-500/50 hover:bg-purple-500/5 transition group text-center">
                            <svg class="w-5 h-5 text-purple-500 mb-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                            <span class="font-mono-tech text-[10px] uppercase text-slate-600 dark:text-slate-400 group-hover:text-purple-500">Upgrade</span>
                        </a>
                    </div>
                </div>

                {{-- Announcements --}}
                <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 p-5">
                    <div class="font-mono-tech text-[10px] uppercase text-slate-400 dark:text-slate-500 mb-3">// ANNOUNCEMENTS</div>
                    <div class="space-y-3">
                        @forelse($announcements as $ann)
                            <div class="border-l-2 border-indigo-500/50 pl-3">
                                <div class="text-xs font-bold text-slate-900 dark:text-white">{{ $ann->title }}</div>
                                <div class="text-[10px] text-slate-500 dark:text-slate-400 mt-0.5 line-clamp-2">{{ $ann->content }}</div>
                            </div>
                        @empty
                            <div class="text-center text-slate-400 font-mono-tech text-[10px]">// NO_ANNOUNCEMENTS</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- TradingView Market Chart --}}
        <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-200 dark:border-slate-800 flex items-center gap-2">
                <span class="font-mono-tech text-[10px] uppercase text-slate-400 dark:text-slate-500">// LIVE_MARKET_CHART</span>
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
            </div>
            <div style="height: 450px;">
                <div class="tradingview-widget-container" style="height:100%;width:100%">
                    <div id="tradingview_dashboard" style="height:100%;width:100%"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                    <script type="text/javascript">
                        new TradingView.widget({
                            "autosize": true,
                            "symbol": "BINANCE:BTCUSDT",
                            "interval": "60",
                            "timezone": "Etc/UTC",
                            "theme": "dark",
                            "style": "1",
                            "locale": "en",
                            "enable_publishing": false,
                            "hide_side_toolbar": false,
                            "allow_symbol_change": true,
                            "container_id": "tradingview_dashboard"
                        });
                    </script>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
