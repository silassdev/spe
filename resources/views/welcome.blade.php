<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CryptoCore | Technical Grid Quantitative Crypto Membership Platform</title>
    <meta name="description" content="Access high-yield quantitative cryptocurrency memberships, real-time blockchain tracking, and advanced portfolio analytics through a secure technical interface.">

    <!-- Fonts: Outfit (Sans) and JetBrains Mono (Tech HUD) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700;800&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Inline script to force dark mode for premium look -->
    <script>
        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.remove('dark');
        } else {
            document.documentElement.classList.add('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
        .font-mono-tech {
            font-family: 'JetBrains Mono', monospace;
        }
        .glow-indigo {
            text-shadow: 0 0 15px rgba(99, 102, 241, 0.4);
        }
        .grid-glow {
            box-shadow: inset 0 0 50px rgba(99, 102, 241, 0.05), 0 0 20px rgba(99, 102, 241, 0.05);
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased transition-colors duration-300 min-h-screen flex flex-col relative overflow-x-hidden">

    <!-- Connected Mesh Squares Background -->
    <x-tech-squares />

    <!-- Sticky Technical Grid Navbar -->
    <x-navbar />

    <!-- Main Workspace -->
    <main class="flex-grow">

        <!-- SECTION: HERO SECTION -->
        <section class="relative border-b border-slate-200 dark:border-slate-800/60 overflow-hidden">
            <!-- Grid Matrix Overlay lines -->
            <div class="absolute inset-0 flex pointer-events-none z-0 opacity-20 dark:opacity-35">
                <div class="w-1/4 h-full border-r border-slate-200/50 dark:border-slate-800 hidden md:block"></div>
                <div class="w-1/4 h-full border-r border-slate-200/50 dark:border-slate-800 hidden md:block"></div>
                <div class="w-1/4 h-full border-r border-slate-200/50 dark:border-slate-800 hidden md:block"></div>
                <div class="w-1/4 h-full hidden md:block"></div>
            </div>

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 border-l border-r border-slate-200/60 dark:border-slate-800/40 relative z-10 py-16 lg:py-24">
                
                <!-- Corner ticks -->
                <div class="absolute -top-1.5 -left-1.5 text-indigo-500 font-mono text-xs select-none pointer-events-none">+</div>
                <div class="absolute -top-1.5 -right-1.5 text-indigo-500 font-mono text-xs select-none pointer-events-none">+</div>
                
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    
                    <!-- Left Column: Quantitative Title & CTA -->
                    <div class="lg:col-span-7 space-y-6" id="hero-left">
                        <div class="inline-flex items-center gap-2 rounded-lg border border-indigo-500/20 bg-indigo-500/10 px-3 py-1.5 text-xs font-mono-tech text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">
                            <span class="inline-block w-2 h-2 rounded-full bg-indigo-500 animate-ping"></span>
                            QUANT_ENGINE // MAINNET_CONNECTED
                        </div>

                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 dark:text-white leading-[1.1]">
                            Automated Crypto Investments, <span class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 bg-clip-text text-transparent glow-indigo">Grid Solved.</span>
                        </h1>

                        <p class="max-w-xl text-base sm:text-lg leading-relaxed text-slate-500 dark:text-slate-400">
                            CryptoCore is a futuristic, grid-stabilized quant platform that distributes daily yield dividends across 5 optimized Membership Levels. Deposit BTC, ETH, USDT, or BNB, and experience seamless, risk-adjusted quantitative ROI execution.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4 pt-2">
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 hover:bg-indigo-500 transition-all duration-200 font-mono-tech">
                                INITIALIZE_ACCOUNT &rarr;
                            </a>
                            <a href="#tiers" class="inline-flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-800 bg-white/60 dark:bg-slate-900/40 px-6 py-3.5 text-sm font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition duration-200 font-mono-tech">
                                VIEW_MEMBERSHIPS //
                            </a>
                        </div>

                        <!-- System metrics grid -->
                        <div class="grid grid-cols-3 gap-4 pt-6 border-t border-slate-200 dark:border-slate-800/80 max-w-xl">
                            <div class="rounded-lg border border-slate-200 dark:border-slate-800/60 bg-white/40 dark:bg-slate-900/10 p-3.5">
                                <div class="text-[10px] font-mono-tech uppercase text-slate-400 dark:text-slate-500">// ACTIVE_NODES</div>
                                <div class="text-xl font-bold font-mono-tech text-slate-800 dark:text-white mt-1">{{ $totalUsers }}</div>
                            </div>
                            <div class="rounded-lg border border-slate-200 dark:border-slate-800/60 bg-white/40 dark:bg-slate-900/10 p-3.5">
                                <div class="text-[10px] font-mono-tech uppercase text-slate-400 dark:text-slate-500">// TOTAL_DEPOSITS</div>
                                <div class="text-xl font-bold font-mono-tech text-slate-800 dark:text-white mt-1">${{ number_format($totalDeposited, 0) }}</div>
                            </div>
                            <div class="rounded-lg border border-slate-200 dark:border-slate-800/60 bg-white/40 dark:bg-slate-900/10 p-3.5">
                                <div class="text-[10px] font-mono-tech uppercase text-slate-400 dark:text-slate-500">// SECURITY_STATUS</div>
                                <div class="text-xl font-bold font-mono-tech text-indigo-500 dark:text-indigo-400 mt-1">HASHED_PIN</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Interactive Live Price Ticker & Txt Log Mockup -->
                    <div class="lg:col-span-5 relative" 
                         x-data="{
                            prices: {
                                BTC: { price: 67240.50, change: 0.12 },
                                ETH: { price: 3482.20, change: -0.05 },
                                SOL: { price: 142.80, change: 1.45 },
                                BNB: { price: 585.10, change: 0.32 },
                                DOGE: { price: 0.1245, change: -1.25 },
                                ADA: { price: 0.3842, change: 0.05 },
                                XRP: { price: 0.4950, change: 0.00 }
                            },
                            updatePrices() {
                                setInterval(() => {
                                    Object.keys(this.prices).forEach(key => {
                                        let diff = (Math.random() - 0.5) * (this.prices[key].price * 0.003);
                                        this.prices[key].price = parseFloat((this.prices[key].price + diff).toFixed(key === 'DOGE' || key === 'ADA' || key === 'XRP' ? 4 : 2));
                                        this.prices[key].change = parseFloat(((Math.random() - 0.5) * 3).toFixed(2));
                                    });
                                }, 3000);
                            }
                         }"
                         x-init="updatePrices()"
                    >
                        <!-- Glow effect -->
                        <div class="absolute -inset-1 rounded-2xl bg-gradient-to-r from-indigo-500 to-purple-600 opacity-20 blur-xl"></div>
                        
                        <div class="relative rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-5 shadow-xl transition-all duration-300">
                            <!-- Technical line header -->
                            <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 pb-3 mb-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 rounded-full bg-rose-500"></div>
                                    <div class="w-3 h-3 rounded-full bg-amber-500"></div>
                                    <div class="w-3 h-3 rounded-full bg-indigo-500"></div>
                                </div>
                                <span class="font-mono-tech text-[10px] text-slate-400 dark:text-slate-500">SYS_TELEMETRY // LIVE_FEED</span>
                            </div>

                            <!-- Live Cryptocore Prices HUD -->
                            <div class="space-y-3">
                                <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 p-4">
                                    <h3 class="font-mono-tech text-xs uppercase text-slate-400 dark:text-slate-500 mb-3">// LIVE_COIN_INDEX</h3>
                                    
                                    <div class="divide-y divide-slate-200/50 dark:divide-slate-800/80 space-y-2">
                                        <template x-for="(coin, key) in prices" :key="key">
                                            <div class="flex justify-between items-center pt-2 first:pt-0">
                                                <div class="flex items-center gap-2">
                                                    <span class="font-mono-tech text-xs font-bold text-slate-900 dark:text-white" x-text="key">BTC</span>
                                                    <span class="text-[9px] font-mono-tech uppercase text-slate-400 dark:text-slate-500">USDT</span>
                                                </div>
                                                <div class="text-right">
                                                    <span class="font-mono-tech text-xs font-semibold text-slate-800 dark:text-slate-200" x-text="'$' + coin.price.toLocaleString()">$67,240.50</span>
                                                    <span :class="coin.change >= 0 ? 'text-emerald-500' : 'text-rose-500'" class="font-mono-tech text-[10px] ml-2 font-bold" x-text="(coin.change >= 0 ? '+' : '') + coin.change + '%'">+0.12%</span>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <!-- Scrolling Logs Window -->
                                <div class="rounded-lg border border-slate-200 dark:border-slate-800 bg-slate-950 p-3"
                                     x-data="{
                                        logs: [
                                            '[22:37:45] DB_SYS: Quant pipeline loaded.',
                                            '[22:37:50] BLOCK_NET: Block #19948271 sync OK.',
                                            '[22:38:01] QUANT_SYS: ROI recalculations processed.'
                                        ],
                                        logOptions: [
                                            'DEPOSIT: Silas deposited 350.00 USDT.',
                                            'UPGRADE: User john upgraded to Silver Level.',
                                            'WITHDRAWAL: Payout request for 100.00 USDT submitted.',
                                            'COMMISSION: Dispatched $25.00 referral bonus.',
                                            'ROUTER: Distributed ROI profit yield to active users.',
                                            'BLOCK_NET: Hashed block TX signature confirmation.'
                                        ],
                                        init() {
                                            setInterval(() => {
                                                let rand = this.logOptions[Math.floor(Math.random() * this.logOptions.length)];
                                                let now = new Date();
                                                let timeStr = '[' + now.toTimeString().split(' ')[0] + '] ';
                                                this.logs.push(timeStr + rand);
                                                if(this.logs.length > 5) {
                                                    this.logs.shift();
                                                }
                                            }, 4000);
                                        }
                                     }"
                                >
                                    <div class="flex items-center justify-between border-b border-slate-850 pb-2 mb-2">
                                        <span class="font-mono-tech text-[9px] text-indigo-400">LEDGER_OPS // LOGS_STREAM</span>
                                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
                                    </div>
                                    <div class="h-28 overflow-hidden space-y-1 text-[10px] font-mono-tech text-slate-400 select-none">
                                        <template x-for="(log, idx) in logs" :key="idx">
                                            <div class="truncate">
                                                <span class="text-indigo-500">&gt;</span> <span x-text="log"></span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION: MEMBERSHIP TIERS MATRIX -->
        <section id="tiers" class="relative border-b border-slate-200 dark:border-slate-800/60 py-20 bg-slate-100/30 dark:bg-slate-950/20 transition-colors duration-300">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 border-l border-r border-slate-200/60 dark:border-slate-800/40 relative z-10">
                <div class="max-w-2xl mb-12">
                    <span class="font-mono-tech text-xs uppercase tracking-widest text-indigo-500">// MODULES_PORTFOLIO</span>
                    <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white mt-2 sm:text-4xl">System Membership Tiers</h2>
                    <p class="mt-4 text-slate-500 dark:text-slate-400">
                        Choose your optimal quant node size. Each level is configured with a custom pricing threshold, daily ROI return percentages, and cycle durations.
                    </p>
                </div>

                <!-- Tiers comparative grid layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-px bg-slate-200 dark:bg-slate-800/60 rounded-xl overflow-hidden shadow-sm">
                    @foreach($tiers as $tier)
                        @php
                            $colors = [
                                'Bronze' => ['border' => 'group-hover:border-amber-700/50', 'text' => 'text-amber-600', 'bg' => 'bg-amber-600/10'],
                                'Silver' => ['border' => 'group-hover:border-slate-400/50', 'text' => 'text-slate-400', 'bg' => 'bg-slate-400/10'],
                                'Gold' => ['border' => 'group-hover:border-yellow-500/50', 'text' => 'text-yellow-500', 'bg' => 'bg-yellow-500/10'],
                                'Platinum' => ['border' => 'group-hover:border-cyan-400/50', 'text' => 'text-cyan-400', 'bg' => 'bg-cyan-400/10'],
                                'Diamond' => ['border' => 'group-hover:border-indigo-400/50', 'text' => 'text-indigo-400', 'bg' => 'bg-indigo-400/10'],
                            ];
                            $theme = $colors[$tier->name] ?? ['border' => 'group-hover:border-indigo-500/50', 'text' => 'text-indigo-500', 'bg' => 'bg-indigo-500/10'];
                        @endphp
                        <div class="bg-white dark:bg-slate-950 p-6 hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition-all duration-300 relative group border-glow-indigo-hover">
                            <!-- Crosshairs -->
                            <div class="absolute top-2 left-2 text-[9px] text-slate-300 dark:text-slate-800 font-mono select-none pointer-events-none">+</div>
                            <div class="absolute bottom-2 right-2 text-[9px] text-slate-300 dark:text-slate-800 font-mono select-none pointer-events-none">+</div>

                            <div class="flex items-center justify-between mb-4">
                                <span class="text-[10px] font-mono-tech {{ $theme['text'] }} {{ $theme['bg'] }} px-2 py-0.5 rounded uppercase tracking-wider">Level {{ $loop->iteration }}</span>
                                <span class="font-mono-tech text-slate-300 dark:text-slate-700 text-sm font-black group-hover:text-indigo-500 transition-colors">0{{ $loop->iteration }}</span>
                            </div>

                            <h3 class="text-xl font-bold text-slate-900 dark:text-white">{{ $tier->name }}</h3>
                            
                            <div class="mt-4 space-y-1.5 border-b border-t border-slate-100 dark:border-slate-900 py-4 my-4 font-mono-tech">
                                <div class="flex justify-between text-xs">
                                    <span class="text-slate-400">// PLAN_PRICE:</span>
                                    <span class="font-bold text-slate-800 dark:text-white">${{ number_format($tier->price, 0) }}</span>
                                </div>
                                <div class="flex justify-between text-xs">
                                    <span class="text-slate-400">// DAILY_ROI:</span>
                                    <span class="font-bold text-indigo-500">{{ $tier->daily_roi }}%</span>
                                </div>
                                <div class="flex justify-between text-xs">
                                    <span class="text-slate-400">// DURATION:</span>
                                    <span class="font-bold text-slate-800 dark:text-white">{{ $tier->duration }} Days</span>
                                </div>
                            </div>

                            <p class="text-xs text-slate-500 dark:text-slate-400 min-h-[50px]">
                                Earn {{ $tier->daily_roi }}% ROI daily. Accrued yield matures and expunges in {{ $tier->duration }} days.
                            </p>

                            <div class="mt-6">
                                <a href="{{ route('membership', ['tier_id' => $tier->id]) }}" class="w-full text-center block rounded bg-slate-100 dark:bg-slate-900 hover:bg-indigo-600 hover:text-white text-slate-700 dark:text-slate-300 px-3 py-2 text-xs font-bold transition font-mono-tech uppercase">
                                    UPGRADE_PLAN &rarr;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- SECTION: INTERACTIVE ROI CALCULATOR -->
        <section class="relative border-b border-slate-200 dark:border-slate-800/60 py-20 overflow-hidden">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 border-l border-r border-slate-200/60 dark:border-slate-800/40 relative z-10">
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <span class="font-mono-tech text-xs uppercase tracking-widest text-indigo-500">// QUANT_PROJECTIONS</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white mt-3">
                        Interactive Yield Calculator
                    </h2>
                    <p class="text-slate-500 dark:text-slate-400 mt-4 max-w-xl mx-auto">
                        Tweak the investment parameters below to simulate your net quantitative returns, daily dividend distributions, and total ROI yield outputs.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch"
                     x-data="{
                        investmentAmount: 1000,
                        tiersList: [
                            { name: 'Bronze', price: 100, roi: 1.20, duration: 30 },
                            { name: 'Silver', price: 500, roi: 1.50, duration: 45 },
                            { name: 'Gold', price: 2500, roi: 1.80, duration: 60 },
                            { name: 'Platinum', price: 10000, roi: 2.20, duration: 90 },
                            { name: 'Diamond', price: 50000, roi: 2.80, duration: 120 }
                        ],
                        get currentTier() {
                            // Find tier based on investment amount thresholds
                            let matched = this.tiersList[0];
                            for (let i = 0; i < this.tiersList.length; i++) {
                                if (this.investmentAmount >= this.tiersList[i].price) {
                                    matched = this.tiersList[i];
                                }
                            }
                            return matched;
                        },
                        get dailyReturn() {
                            return (this.investmentAmount * (this.currentTier.roi / 100)).toFixed(2);
                        },
                        get totalReturn() {
                            return (this.dailyReturn * this.currentTier.duration).toFixed(2);
                        },
                        get netProfit() {
                            return (this.totalReturn - this.investmentAmount).toFixed(2);
                        }
                     }"
                >
                    <!-- Sliders Control Panel -->
                    <div class="lg:col-span-7 rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-6 sm:p-8 flex flex-col justify-between shadow-md">
                        <div>
                            <h3 class="font-bold text-lg text-slate-900 dark:text-white mb-6 border-b border-slate-100 dark:border-slate-800 pb-3">// Telemetry Setup</h3>
                            
                            <!-- Slider Block -->
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Target Investment Principal</label>
                                    <span class="font-mono-tech text-indigo-500 font-bold bg-indigo-500/10 px-2.5 py-0.5 rounded text-sm" x-text="'$' + parseInt(investmentAmount).toLocaleString()">$1,000</span>
                                </div>
                                <input 
                                    type="range" 
                                    min="100" 
                                    max="100000" 
                                    step="100" 
                                    x-model="investmentAmount"
                                    class="w-full h-1.5 bg-slate-200 dark:bg-slate-800 rounded-lg appearance-none cursor-pointer accent-indigo-500"
                                >
                                <div class="flex justify-between text-[10px] text-slate-400 dark:text-slate-500 font-mono-tech">
                                    <span>$100 (BRONZE MIN)</span>
                                    <span>$2,500 (GOLD MIN)</span>
                                    <span>$100,000 (DIAMOND MAX)</span>
                                </div>
                            </div>
                        </div>

                        <!-- System Level alert notification tag -->
                        <div class="mt-8 rounded-xl border border-indigo-500/20 bg-indigo-500/5 p-4 flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-indigo-500/20 flex items-center justify-center text-indigo-500 font-black">✔</div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-900 dark:text-white">Active Tier: <span x-text="currentTier.name">Silver</span> Node</h4>
                                <p class="text-xs text-slate-500 dark:text-slate-400">
                                    An investment principal of $<span x-text="parseInt(investmentAmount).toLocaleString()"></span> matches <span x-text="currentTier.name">Silver</span> specifications (<span x-text="currentTier.roi">%</span> Daily ROI for <span x-text="currentTier.duration"></span> days).
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Readings Panel -->
                    <div class="lg:col-span-5 rounded-2xl border border-slate-200 dark:border-slate-800 bg-slate-900 dark:bg-slate-950 text-white p-6 sm:p-8 flex flex-col justify-between shadow-xl relative overflow-hidden">
                        <!-- Top glow ribbon -->
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

                        <div class="space-y-6">
                            <span class="font-mono-tech text-[10px] text-slate-500 tracking-widest block uppercase">// QUANT_LEDGER_PROJECTIONS</span>
                            
                            <div>
                                <div class="text-xs text-slate-400">Est. Daily Dividends:</div>
                                <div class="text-3xl font-black font-mono-tech text-white mt-1" x-text="'$' + dailyReturn">$15.00</div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 border-t border-slate-800 pt-4">
                                <div>
                                    <div class="text-[10px] text-slate-400 uppercase font-mono-tech">// Net Profit Yield</div>
                                    <div class="text-lg font-bold font-mono-tech text-indigo-400 mt-1" x-text="'$' + netProfit">$175.00</div>
                                </div>
                                <div>
                                    <div class="text-[10px] text-slate-400 uppercase font-mono-tech">// Cycle Duration</div>
                                    <div class="text-lg font-bold font-mono-tech text-white mt-1" x-text="currentTier.duration + ' days'">45 days</div>
                                </div>
                            </div>

                            <div class="border-t border-slate-800 pt-4 bg-slate-950/80 -mx-6 px-6 -mb-6 pb-6 rounded-b-2xl">
                                <div class="text-[10px] text-slate-400 uppercase font-mono-tech">// Total Payout (Capital + Interest)</div>
                                <div class="text-2xl font-black font-mono-tech text-indigo-400 mt-2 flex items-center gap-2" x-text="'$' + totalReturn">
                                    $1,175.00
                                </div>
                                <span class="text-[10px] text-indigo-400/80 font-mono-tech tracking-wider block mt-1">YIELD_CALCULATED: SUCCESS</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION: TRADINGVIEW LIVE MARKET CHART -->
        <section id="chart" class="relative border-b border-slate-200 dark:border-slate-800/60 py-20 bg-slate-100/10 dark:bg-slate-950/40 transition-colors duration-300">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 border-l border-r border-slate-200/60 dark:border-slate-800/40 relative z-10">
                <div class="max-w-2xl mb-12">
                    <span class="font-mono-tech text-xs uppercase tracking-widest text-indigo-500">// TECHNICAL_CHARTS</span>
                    <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white mt-2">Live Market Chart Analysis</h2>
                    <p class="mt-4 text-slate-500 dark:text-slate-400">
                        Interactive TradingView market dashboard. Toggle indicators, drawing tools, timeframes, and switch between candlestick metrics in real time.
                    </p>
                </div>

                <!-- TradingView Embedded Container -->
                <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-900 h-[500px] overflow-hidden shadow-lg relative">
                    <!-- TradingView Widget BEGIN -->
                    <div class="tradingview-widget-container" style="height: 100%; width: 100%;">
                        <div id="tradingview_chart_landing" style="height: 100%; width: 100%;"></div>
                        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                        <script type="text/javascript">
                            new TradingView.widget({
                                "autosize": true,
                                "symbol": "BINANCE:BTCUSDT",
                                "interval": "D",
                                "timezone": "Etc/UTC",
                                "theme": "dark",
                                "style": "1",
                                "locale": "en",
                                "enable_publishing": false,
                                "hide_side_toolbar": false,
                                "allow_symbol_change": true,
                                "container_id": "tradingview_chart_landing"
                            });
                        </script>
                    </div>
                    <!-- TradingView Widget END -->
                </div>
            </div>
        </section>

    </main>

    <!-- Site Footer component -->
    <x-footer />

</body>
</html>