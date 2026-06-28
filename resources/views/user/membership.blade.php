<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-slate-500 font-mono-tech text-xs">+</span>
                <h2 class="font-mono-tech text-sm font-semibold text-indigo-400 tracking-widest uppercase">
                    // MEMBERSHIP_UPGRADE
                </h2>
                <span class="text-slate-500 font-mono-tech text-xs">+</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-slate-600 font-mono-tech text-xs">TIER_STATUS:</span>
                <span class="font-mono-tech text-xs px-2 py-0.5 rounded border border-indigo-500/40 bg-indigo-500/10 text-indigo-300">
                    {{ $user->tier->name ?? 'None' }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 px-4 md:px-8 space-y-8">

        {{-- Flash Message --}}
        @if (session('upgrade-submitted'))
            <div class="relative border border-emerald-500/40 bg-emerald-500/10 rounded-md px-5 py-4 flex items-start gap-3">
                <span class="text-emerald-400 font-mono-tech text-lg leading-none">✓</span>
                <div>
                    <p class="font-mono-tech text-xs text-emerald-300 tracking-wider uppercase">// UPGRADE_SUBMITTED</p>
                    <p class="text-sm text-emerald-200 mt-1">{{ session('upgrade-submitted') }}</p>
                </div>
                <span class="absolute top-2 right-2 text-emerald-700 font-mono-tech text-xs">+</span>
                <span class="absolute bottom-2 left-2 text-emerald-700 font-mono-tech text-xs">+</span>
            </div>
        @endif

        {{-- Current Membership Status --}}
        <div class="relative border border-slate-700/60 bg-slate-900/80 rounded-md p-6">
            <span class="absolute top-2 left-2 text-slate-600 font-mono-tech text-xs">+</span>
            <span class="absolute top-2 right-2 text-slate-600 font-mono-tech text-xs">+</span>
            <span class="absolute bottom-2 left-2 text-slate-600 font-mono-tech text-xs">+</span>
            <span class="absolute bottom-2 right-2 text-slate-600 font-mono-tech text-xs">+</span>

            <p class="font-mono-tech text-xs text-slate-500 tracking-widest uppercase mb-3">// CURRENT_TIER</p>
            <div class="flex flex-wrap items-center gap-6">
                <div>
                    <p class="text-slate-400 text-xs font-mono-tech mb-1">Active Membership</p>
                    <p class="text-2xl font-mono-tech font-bold text-white">{{ $user->tier->name ?? 'No Active Plan' }}</p>
                </div>
                @if ($user->tier)
                    <div class="flex flex-wrap gap-6">
                        <div>
                            <p class="text-slate-500 text-xs font-mono-tech mb-1">Daily ROI</p>
                            <p class="text-emerald-400 font-mono-tech font-semibold">{{ $user->tier->daily_roi ?? '—' }}%</p>
                        </div>
                        <div>
                            <p class="text-slate-500 text-xs font-mono-tech mb-1">Duration</p>
                            <p class="text-indigo-400 font-mono-tech font-semibold">{{ $user->tier->duration ?? '—' }} days</p>
                        </div>
                        <div>
                            <p class="text-slate-500 text-xs font-mono-tech mb-1">Price Paid</p>
                            <p class="text-white font-mono-tech font-semibold">${{ number_format($user->tier->price ?? 0, 2) }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Tier Comparison Table --}}
        <div class="relative border border-slate-700/60 bg-slate-900/80 rounded-md overflow-hidden">
            <span class="absolute top-2 left-2 text-slate-600 font-mono-tech text-xs z-10">+</span>
            <span class="absolute top-2 right-2 text-slate-600 font-mono-tech text-xs z-10">+</span>

            <div class="px-6 py-4 border-b border-slate-700/60 flex items-center gap-3">
                <p class="font-mono-tech text-xs text-slate-400 tracking-widest uppercase">// AVAILABLE_TIERS</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-slate-700/60 bg-slate-800/60">
                            <th class="text-left px-5 py-3 font-mono-tech text-xs text-slate-500 tracking-widest uppercase">Level</th>
                            <th class="text-left px-5 py-3 font-mono-tech text-xs text-slate-500 tracking-widest uppercase">Name</th>
                            <th class="text-left px-5 py-3 font-mono-tech text-xs text-slate-500 tracking-widest uppercase">Price</th>
                            <th class="text-left px-5 py-3 font-mono-tech text-xs text-slate-500 tracking-widest uppercase">Daily ROI</th>
                            <th class="text-left px-5 py-3 font-mono-tech text-xs text-slate-500 tracking-widest uppercase">Duration</th>
                            <th class="text-left px-5 py-3 font-mono-tech text-xs text-slate-500 tracking-widest uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/40">
                        @forelse ($tiers as $tier)
                            <tr class="hover:bg-slate-800/40 transition-colors {{ ($user->tier && $user->tier->id === $tier->id) ? 'bg-indigo-900/20 border-l-2 border-l-indigo-500' : '' }}">
                                <td class="px-5 py-4">
                                    <span class="font-mono-tech text-xs text-slate-400">#{{ $tier->level ?? $loop->iteration }}</span>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-2">
                                        <span class="font-mono-tech text-sm font-semibold text-white">{{ $tier->name }}</span>
                                        @if ($user->tier && $user->tier->id === $tier->id)
                                            <span class="font-mono-tech text-xs px-1.5 py-0.5 rounded bg-indigo-600/30 text-indigo-300 border border-indigo-500/40">ACTIVE</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-5 py-4">
                                    <span class="font-mono-tech text-sm text-white">${{ number_format($tier->price, 2) }}</span>
                                </td>
                                <td class="px-5 py-4">
                                    <span class="font-mono-tech text-sm text-emerald-400">{{ $tier->daily_roi }}%</span>
                                </td>
                                <td class="px-5 py-4">
                                    <span class="font-mono-tech text-sm text-slate-300">{{ $tier->duration }} days</span>
                                </td>
                                <td class="px-5 py-4">
                                    <a href="{{ route('membership', ['tier_id' => $tier->id]) }}"
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded text-xs font-mono-tech font-medium
                                              {{ ($user->tier && $user->tier->id === $tier->id)
                                                  ? 'bg-slate-700/60 text-slate-400 cursor-default pointer-events-none border border-slate-600/40'
                                                  : 'bg-indigo-600 hover:bg-indigo-500 text-white border border-indigo-500 transition-colors' }}">
                                        @if ($user->tier && $user->tier->id === $tier->id)
                                            ✓ Current Plan
                                        @else
                                            Upgrade to {{ $tier->name }}
                                        @endif
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-10 text-center font-mono-tech text-xs text-slate-600 tracking-widest">
                                    // NO_TIERS_AVAILABLE
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <span class="absolute bottom-2 left-2 text-slate-600 font-mono-tech text-xs">+</span>
            <span class="absolute bottom-2 right-2 text-slate-600 font-mono-tech text-xs">+</span>
        </div>

        {{-- Upgrade Form Panel (shown when $selectedTier is set) --}}
        @isset($selectedTier)
            <div x-data="{
                    copied: null,
                    copyAddress(text, id) {
                        navigator.clipboard.writeText(text).then(() => {
                            this.copied = id;
                            setTimeout(() => this.copied = null, 2000);
                        });
                    }
                }"
                 class="relative border border-indigo-500/40 bg-slate-900/90 rounded-md overflow-hidden shadow-lg shadow-indigo-900/20">

                <span class="absolute top-2 left-2 text-indigo-700 font-mono-tech text-xs z-10">+</span>
                <span class="absolute top-2 right-2 text-indigo-700 font-mono-tech text-xs z-10">+</span>
                <span class="absolute bottom-2 left-2 text-indigo-700 font-mono-tech text-xs z-10">+</span>
                <span class="absolute bottom-2 right-2 text-indigo-700 font-mono-tech text-xs z-10">+</span>

                {{-- Panel Header --}}
                <div class="px-6 py-4 border-b border-indigo-500/30 bg-indigo-900/20 flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <p class="font-mono-tech text-xs text-indigo-400 tracking-widest uppercase mb-1">// UPGRADE_FORM</p>
                        <h3 class="font-mono-tech text-lg font-bold text-white">
                            Upgrading to <span class="text-indigo-400">{{ $selectedTier->name }}</span>
                        </h3>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <p class="text-slate-500 text-xs font-mono-tech">Amount Due</p>
                            <p class="text-2xl font-mono-tech font-bold text-indigo-300">${{ number_format($selectedTier->price, 2) }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-6">

                    {{-- Instructions --}}
                    <div class="border border-slate-700/60 bg-slate-800/40 rounded p-4">
                        <p class="font-mono-tech text-xs text-slate-500 tracking-widest uppercase mb-2">// PAYMENT_INSTRUCTIONS</p>
                        <ol class="space-y-1.5 text-sm text-slate-300 list-decimal list-inside font-mono-tech">
                            <li>Select your preferred cryptocurrency below.</li>
                            <li>Send exactly <span class="text-indigo-300 font-semibold">${{ number_format($selectedTier->price, 2) }}</span> worth of the selected coin to the wallet address provided.</li>
                            <li>Copy the transaction hash from your wallet after sending.</li>
                            <li>Upload a screenshot of the transaction as proof.</li>
                            <li>Submit the form — your upgrade will be reviewed within 24 hours.</li>
                        </ol>
                    </div>

                    {{-- Admin Wallet Addresses Table --}}
                    <div>
                        <p class="font-mono-tech text-xs text-slate-500 tracking-widest uppercase mb-3">// ADMIN_WALLET_ADDRESSES</p>
                        <div class="border border-slate-700/60 rounded overflow-hidden">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="bg-slate-800/70 border-b border-slate-700/60">
                                        <th class="text-left px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest uppercase">Coin</th>
                                        <th class="text-left px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest uppercase">Symbol</th>
                                        <th class="text-left px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest uppercase">Wallet Address</th>
                                        <th class="text-left px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest uppercase">Copy</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-700/40">
                                    @forelse ($adminWallets as $wallet)
                                        <tr class="hover:bg-slate-800/30 transition-colors">
                                            <td class="px-4 py-3 font-mono-tech text-sm text-white">{{ $wallet->coin_name }}</td>
                                            <td class="px-4 py-3">
                                                <span class="font-mono-tech text-xs px-2 py-0.5 rounded bg-indigo-900/40 text-indigo-300 border border-indigo-500/30">
                                                    {{ $wallet->coin_symbol }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <span class="font-mono-tech text-xs text-slate-300 break-all select-all">{{ $wallet->address }}</span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <button type="button"
                                                        @click="copyAddress('{{ $wallet->address }}', {{ $wallet->id }})"
                                                        class="inline-flex items-center gap-1 px-2 py-1 rounded text-xs font-mono-tech border transition-colors"
                                                        :class="copied === {{ $wallet->id }}
                                                            ? 'border-emerald-500/40 bg-emerald-500/10 text-emerald-400'
                                                            : 'border-slate-600/40 bg-slate-700/40 text-slate-400 hover:text-indigo-400 hover:border-indigo-500/40'">
                                                    <span x-show="copied !== {{ $wallet->id }}">⎘ Copy</span>
                                                    <span x-show="copied === {{ $wallet->id }}">✓ Copied</span>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-4 py-8 text-center font-mono-tech text-xs text-slate-600 tracking-widest">
                                                // NO_WALLET_ADDRESSES_CONFIGURED
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Upgrade Form --}}
                    <form action="{{ route('membership.upgrade') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        <input type="hidden" name="tier_id" value="{{ $selectedTier->id }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            {{-- Currency Select --}}
                            <div>
                                <label class="block font-mono-tech text-xs text-slate-400 tracking-widest uppercase mb-2">
                                    // PAYMENT_CURRENCY
                                </label>
                                <select name="currency"
                                        class="w-full bg-slate-800/70 border border-slate-600/60 rounded px-4 py-2.5 text-sm font-mono-tech text-white
                                               focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/40 transition-colors
                                               @error('currency') border-rose-500 @enderror">
                                    <option value="" disabled selected class="text-slate-500">Select currency...</option>
                                    <option value="BTC" {{ old('currency') === 'BTC' ? 'selected' : '' }}>BTC — Bitcoin</option>
                                    <option value="ETH" {{ old('currency') === 'ETH' ? 'selected' : '' }}>ETH — Ethereum</option>
                                    <option value="USDT" {{ old('currency') === 'USDT' ? 'selected' : '' }}>USDT — Tether</option>
                                    <option value="BNB" {{ old('currency') === 'BNB' ? 'selected' : '' }}>BNB — BNB Chain</option>
                                </select>
                                @error('currency')
                                    <p class="mt-1 text-xs font-mono-tech text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Transaction Hash --}}
                            <div>
                                <label class="block font-mono-tech text-xs text-slate-400 tracking-widest uppercase mb-2">
                                    // TRANSACTION_HASH
                                </label>
                                <input type="text"
                                       name="transaction_hash"
                                       value="{{ old('transaction_hash') }}"
                                       placeholder="0x..."
                                       class="w-full bg-slate-800/70 border border-slate-600/60 rounded px-4 py-2.5 text-sm font-mono-tech text-white
                                              placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/40 transition-colors
                                              @error('transaction_hash') border-rose-500 @enderror">
                                @error('transaction_hash')
                                    <p class="mt-1 text-xs font-mono-tech text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Proof Upload --}}
                        <div>
                            <label class="block font-mono-tech text-xs text-slate-400 tracking-widest uppercase mb-2">
                                // PROOF_OF_PAYMENT
                            </label>
                            <div class="relative border border-dashed border-slate-600/60 rounded bg-slate-800/30 px-5 py-6 text-center hover:border-indigo-500/50 transition-colors
                                        @error('proof_image') border-rose-500 @enderror">
                                <input type="file"
                                       name="proof_image"
                                       accept="image/*"
                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                <div class="pointer-events-none">
                                    <p class="font-mono-tech text-xs text-slate-500 mb-1">↑ Click or drag to upload</p>
                                    <p class="font-mono-tech text-xs text-slate-600">PNG, JPG, WEBP — Max 5MB</p>
                                </div>
                            </div>
                            @error('proof_image')
                                <p class="mt-1 text-xs font-mono-tech text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- PIN Recovery Notice --}}
                        <div class="relative border border-rose-500/40 bg-rose-500/5 rounded px-5 py-4 flex items-start gap-3">
                            <span class="text-rose-400 font-mono-tech text-base leading-none mt-0.5">⚠</span>
                            <div>
                                <p class="font-mono-tech text-xs text-rose-400 tracking-widest uppercase mb-1">// PIN_RECOVERY_NOTICE</p>
                                <p class="text-sm text-rose-300">
                                    Forgot your PIN? Contact admin support — PIN cannot be self-recovered.
                                </p>
                            </div>
                            <span class="absolute top-1.5 right-1.5 text-rose-800 font-mono-tech text-xs">+</span>
                            <span class="absolute bottom-1.5 left-1.5 text-rose-800 font-mono-tech text-xs">+</span>
                        </div>

                        {{-- Submit Button --}}
                        <div class="flex items-center justify-end gap-3 pt-2">
                            <a href="{{ route('membership') }}"
                               class="px-5 py-2.5 rounded text-sm font-mono-tech text-slate-400 border border-slate-600/60 hover:border-slate-500 hover:text-slate-300 transition-colors">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="px-6 py-2.5 rounded text-sm font-mono-tech font-semibold bg-indigo-600 hover:bg-indigo-500 text-white border border-indigo-500 transition-colors tracking-wider">
                                ↑ Submit Upgrade Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endisset

    </div>
</x-app-layout>
