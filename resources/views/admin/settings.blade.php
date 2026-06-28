<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-slate-500 font-mono-tech text-xs">+</span>
                <h2 class="font-mono-tech font-bold text-lg text-indigo-400 tracking-widest uppercase">
                    // SITE_SETTINGS
                </h2>
                <span class="text-slate-500 font-mono-tech text-xs">+</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-screen-2xl mx-auto space-y-6">

        {{-- Flash: Settings Updated --}}
        @if(session('settings-updated'))
            <div class="flex items-center gap-3 bg-emerald-900/30 border border-emerald-500/40 rounded-lg px-4 py-3">
                <span class="font-mono-tech text-xs text-emerald-400">✔</span>
                <span class="font-mono-tech text-xs text-emerald-300">{{ session('settings-updated') }}</span>
            </div>
        @endif

        {{-- Flash: Wallets Updated --}}
        @if(session('wallets-updated'))
            <div class="flex items-center gap-3 bg-indigo-900/30 border border-indigo-500/40 rounded-lg px-4 py-3">
                <span class="font-mono-tech text-xs text-indigo-400">✔</span>
                <span class="font-mono-tech text-xs text-indigo-300">{{ session('wallets-updated') }}</span>
            </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="bg-rose-900/30 border border-rose-500/40 rounded-lg px-4 py-3 space-y-1">
                @foreach($errors->all() as $error)
                    <div class="flex items-center gap-2">
                        <span class="font-mono-tech text-xs text-rose-400">✖</span>
                        <span class="font-mono-tech text-xs text-rose-300">{{ $error }}</span>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- 2-Column Layout --}}
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

            {{-- ══════════════════════════════════════════════ --}}
            {{-- LEFT: General Settings                        --}}
            {{-- ══════════════════════════════════════════════ --}}
            <div class="relative bg-slate-900 border border-slate-700/60 rounded-lg overflow-hidden">
                <div class="absolute -top-1 -left-1 text-slate-600 font-mono-tech text-xs select-none">+</div>
                <div class="absolute -top-1 -right-1 text-slate-600 font-mono-tech text-xs select-none">+</div>
                <div class="absolute -bottom-1 -left-1 text-slate-600 font-mono-tech text-xs select-none">+</div>
                <div class="absolute -bottom-1 -right-1 text-slate-600 font-mono-tech text-xs select-none">+</div>

                {{-- Panel Header --}}
                <div class="px-5 py-3 bg-slate-800/60 border-b border-slate-700/60">
                    <span class="font-mono-tech text-xs text-slate-400 tracking-widest">// GENERAL_CONFIG</span>
                </div>

                <form action="{{ route('admin.settings.update') }}" method="POST" class="p-6 space-y-5">
                    @csrf

                    {{-- Site Name --}}
                    <div class="space-y-2">
                        <label class="block font-mono-tech text-xs text-slate-500 tracking-widest">
                            // SITE_NAME
                        </label>
                        <input
                            type="text"
                            name="site_name"
                            value="{{ old('site_name', $settings['site_name'] ?? '') }}"
                            placeholder="e.g. CryptoCore"
                            class="w-full bg-slate-800 border border-slate-700 rounded px-3 py-2.5 font-mono-tech text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30 transition-colors"
                        />
                    </div>

                    {{-- Maintenance Mode --}}
                    <div class="space-y-2">
                        <label class="block font-mono-tech text-xs text-slate-500 tracking-widest">
                            // MAINTENANCE_MODE
                        </label>
                        <select
                            name="maintenance_mode"
                            class="w-full bg-slate-800 border border-slate-700 rounded px-3 py-2.5 font-mono-tech text-sm text-slate-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30 transition-colors"
                        >
                            <option value="0" {{ (old('maintenance_mode', $settings['maintenance_mode'] ?? '0') == '0') ? 'selected' : '' }}>
                                0 — OFFLINE (disabled)
                            </option>
                            <option value="1" {{ (old('maintenance_mode', $settings['maintenance_mode'] ?? '0') == '1') ? 'selected' : '' }}>
                                1 — ONLINE (enabled)
                            </option>
                        </select>
                        <p class="font-mono-tech text-xs text-slate-600">// 1 = maintenance active, users see holding page</p>
                    </div>

                    {{-- Referral % --}}
                    <div class="space-y-2">
                        <label class="block font-mono-tech text-xs text-slate-500 tracking-widest">
                            // REFERRAL_PERCENT (%)
                        </label>
                        <div class="relative">
                            <input
                                type="number"
                                name="referral_percent"
                                value="{{ old('referral_percent', $settings['referral_percent'] ?? '') }}"
                                placeholder="5"
                                min="0"
                                max="100"
                                step="0.01"
                                class="w-full bg-slate-800 border border-slate-700 rounded px-3 py-2.5 pr-10 font-mono-tech text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30 transition-colors"
                            />
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 font-mono-tech text-xs text-slate-500">%</span>
                        </div>
                    </div>

                    {{-- Min Deposit --}}
                    <div class="space-y-2">
                        <label class="block font-mono-tech text-xs text-slate-500 tracking-widest">
                            // MIN_DEPOSIT (USD)
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 font-mono-tech text-xs text-slate-500">$</span>
                            <input
                                type="number"
                                name="min_deposit"
                                value="{{ old('min_deposit', $settings['min_deposit'] ?? '') }}"
                                placeholder="50.00"
                                min="0"
                                step="0.01"
                                class="w-full bg-slate-800 border border-slate-700 rounded pl-7 pr-3 py-2.5 font-mono-tech text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30 transition-colors"
                            />
                        </div>
                    </div>

                    {{-- Min Withdrawal --}}
                    <div class="space-y-2">
                        <label class="block font-mono-tech text-xs text-slate-500 tracking-widest">
                            // MIN_WITHDRAWAL (USD)
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 font-mono-tech text-xs text-slate-500">$</span>
                            <input
                                type="number"
                                name="min_withdrawal"
                                value="{{ old('min_withdrawal', $settings['min_withdrawal'] ?? '') }}"
                                placeholder="20.00"
                                min="0"
                                step="0.01"
                                class="w-full bg-slate-800 border border-slate-700 rounded pl-7 pr-3 py-2.5 font-mono-tech text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30 transition-colors"
                            />
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-slate-800"></div>

                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 rounded font-mono-tech text-sm text-white tracking-widest transition-colors"
                    >
                        <span class="text-indigo-300">→</span> SAVE_SETTINGS
                    </button>
                </form>
            </div>

            {{-- ══════════════════════════════════════════════ --}}
            {{-- RIGHT: Wallet Addresses                       --}}
            {{-- ══════════════════════════════════════════════ --}}
            <div class="relative bg-slate-900 border border-slate-700/60 rounded-lg overflow-hidden">
                <div class="absolute -top-1 -left-1 text-slate-600 font-mono-tech text-xs select-none">+</div>
                <div class="absolute -top-1 -right-1 text-slate-600 font-mono-tech text-xs select-none">+</div>
                <div class="absolute -bottom-1 -left-1 text-slate-600 font-mono-tech text-xs select-none">+</div>
                <div class="absolute -bottom-1 -right-1 text-slate-600 font-mono-tech text-xs select-none">+</div>

                {{-- Panel Header --}}
                <div class="px-5 py-3 bg-slate-800/60 border-b border-slate-700/60">
                    <span class="font-mono-tech text-xs text-slate-400 tracking-widest">// WALLET_ADDRESSES</span>
                </div>

                <form action="{{ route('admin.settings.wallets') }}" method="POST" class="p-6 space-y-5">
                    @csrf

                    @forelse($wallets as $wallet)
                        <div class="space-y-2">
                            <label class="block font-mono-tech text-xs text-slate-500 tracking-widest">
                                // {{ strtoupper($wallet->coin_name ?? $wallet->coin ?? "WALLET_{$wallet->id}") }}_ADDRESS
                            </label>
                            <div class="relative">
                                <input
                                    type="text"
                                    name="wallet[{{ $wallet->id }}]"
                                    value="{{ old("wallet.{$wallet->id}", $wallet->address ?? '') }}"
                                    placeholder="0x..."
                                    class="w-full bg-slate-800 border border-slate-700 rounded px-3 py-2.5 font-mono-tech text-xs text-slate-300 placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30 transition-colors tracking-wide"
                                />
                                @if($wallet->address ?? null)
                                    <button
                                        type="button"
                                        onclick="navigator.clipboard.writeText('{{ addslashes($wallet->address ?? '') }}')"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 font-mono-tech text-xs text-slate-600 hover:text-indigo-400 transition-colors"
                                        title="Copy"
                                    >⧉</button>
                                @endif
                            </div>
                            @if($wallet->network ?? null)
                                <p class="font-mono-tech text-xs text-slate-700">// network: {{ $wallet->network }}</p>
                            @endif
                        </div>
                    @empty
                        <div class="py-8 text-center">
                            <span class="font-mono-tech text-xs text-slate-600">// NO_WALLETS_CONFIGURED — add wallets to database</span>
                        </div>
                    @endforelse

                    @if($wallets->count() > 0)
                        {{-- Divider --}}
                        <div class="border-t border-slate-800"></div>

                        {{-- Submit --}}
                        <button
                            type="submit"
                            class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 rounded font-mono-tech text-sm text-white tracking-widest transition-colors"
                        >
                            <span class="text-indigo-300">→</span> UPDATE_WALLETS
                        </button>
                    @endif
                </form>
            </div>

        </div>

    </div>
</x-app-layout>
