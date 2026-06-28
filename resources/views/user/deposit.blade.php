<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-slate-500 font-mono-tech text-xs select-none">+</span>
                <h2 class="font-mono-tech text-sm font-semibold text-indigo-400 tracking-widest uppercase">
                    // DEPOSIT_FUNDS
                </h2>
                <span class="text-slate-500 font-mono-tech text-xs select-none">+</span>
            </div>
            <span class="font-mono-tech text-xs text-slate-600">{{ now()->format('Y-m-d H:i:s') }} UTC</span>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-8">

        {{-- ── FLASH MESSAGE ── --}}
        @if (session('status') === 'deposit-submitted')
            <div class="relative border border-emerald-500/40 bg-emerald-950/40 rounded-sm px-5 py-4 flex items-start gap-3">
                <span class="font-mono-tech text-xs text-slate-500 select-none absolute top-1 left-1">+</span>
                <span class="font-mono-tech text-xs text-slate-500 select-none absolute top-1 right-1">+</span>
                <span class="font-mono-tech text-xs text-slate-500 select-none absolute bottom-1 left-1">+</span>
                <span class="font-mono-tech text-xs text-slate-500 select-none absolute bottom-1 right-1">+</span>
                <svg class="w-4 h-4 text-emerald-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <div>
                    <p class="font-mono-tech text-xs text-emerald-400 font-semibold tracking-wider">// DEPOSIT_SUBMITTED</p>
                    <p class="font-mono-tech text-xs text-emerald-300/80 mt-1">Your deposit request has been received. Admin will verify within 2–24 hours.</p>
                </div>
            </div>
        @endif

        {{-- ── TOP SECTION: 2-COLUMN GRID ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            {{-- LEFT COL: DEPOSIT FORM --}}
            <div class="lg:col-span-7">
                <div class="relative border border-slate-700/60 bg-slate-900/70 rounded-sm">
                    {{-- Corner decorations --}}
                    <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute top-1.5 left-2">+</span>
                    <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute top-1.5 right-2">+</span>
                    <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute bottom-1.5 left-2">+</span>
                    <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute bottom-1.5 right-2">+</span>

                    {{-- Panel header --}}
                    <div class="border-b border-slate-700/60 px-5 py-3 flex items-center gap-2">
                        <div class="w-1.5 h-1.5 rounded-full bg-indigo-500"></div>
                        <span class="font-mono-tech text-xs text-slate-400 tracking-widest">// NEW_DEPOSIT_REQUEST</span>
                    </div>

                    <form action="{{ route('deposit.store') }}" method="POST" enctype="multipart/form-data" class="p-5 space-y-5">
                        @csrf

                        {{-- Amount --}}
                        <div class="space-y-1.5">
                            <label class="font-mono-tech text-xs text-slate-400 tracking-wider">// AMOUNT_USD</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-3 flex items-center font-mono-tech text-sm text-slate-500">$</span>
                                <input
                                    type="number"
                                    name="amount"
                                    step="0.01"
                                    min="10"
                                    placeholder="0.00"
                                    value="{{ old('amount') }}"
                                    required
                                    class="w-full pl-7 pr-4 py-2.5 bg-slate-800/80 border border-slate-700 rounded-sm font-mono-tech text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/40 transition"
                                />
                            </div>
                            @error('amount')
                                <p class="font-mono-tech text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Currency --}}
                        <div class="space-y-1.5">
                            <label class="font-mono-tech text-xs text-slate-400 tracking-wider">// CURRENCY</label>
                            <select
                                name="currency"
                                required
                                class="w-full px-3 py-2.5 bg-slate-800/80 border border-slate-700 rounded-sm font-mono-tech text-sm text-slate-200 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/40 transition appearance-none cursor-pointer"
                            >
                                <option value="" disabled {{ old('currency') ? '' : 'selected' }}>-- SELECT_CURRENCY --</option>
                                @foreach(['BTC' => 'Bitcoin (BTC)', 'ETH' => 'Ethereum (ETH)', 'USDT' => 'Tether (USDT)', 'BNB' => 'BNB Chain (BNB)'] as $val => $label)
                                    <option value="{{ $val }}" {{ old('currency') === $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('currency')
                                <p class="font-mono-tech text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Admin Wallet Addresses --}}
                        <div class="space-y-1.5">
                            <label class="font-mono-tech text-xs text-slate-400 tracking-wider">// SEND_PAYMENT_TO</label>
                            <p class="font-mono-tech text-xs text-slate-500">Copy the wallet address for your selected currency and send the exact amount.</p>
                            <div class="border border-slate-700/60 rounded-sm overflow-hidden mt-2">
                                <table class="w-full text-left">
                                    <thead>
                                        <tr class="border-b border-slate-700/60 bg-slate-800/60">
                                            <th class="font-mono-tech text-xs text-slate-500 px-3 py-2 tracking-wider">// COIN</th>
                                            <th class="font-mono-tech text-xs text-slate-500 px-3 py-2 tracking-wider">// SYMBOL</th>
                                            <th class="font-mono-tech text-xs text-slate-500 px-3 py-2 tracking-wider">// ADDRESS</th>
                                            <th class="font-mono-tech text-xs text-slate-500 px-3 py-2 tracking-wider">// COPY</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-700/40">
                                        @forelse($adminWallets as $wallet)
                                            <tr x-data="{ copied: false }" class="hover:bg-slate-800/40 transition">
                                                <td class="font-mono-tech text-xs text-slate-300 px-3 py-2.5">{{ $wallet->coin_name }}</td>
                                                <td class="px-3 py-2.5">
                                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded-sm bg-indigo-950/60 border border-indigo-700/40 font-mono-tech text-xs text-indigo-300">{{ $wallet->coin_symbol }}</span>
                                                </td>
                                                <td class="px-3 py-2.5 max-w-[180px]">
                                                    <span class="font-mono-tech text-xs text-slate-400 truncate block" title="{{ $wallet->address }}">{{ $wallet->address }}</span>
                                                </td>
                                                <td class="px-3 py-2.5">
                                                    <button
                                                        type="button"
                                                        x-on:click="
                                                            navigator.clipboard.writeText('{{ $wallet->address }}');
                                                            copied = true;
                                                            setTimeout(() => copied = false, 2000);
                                                        "
                                                        class="font-mono-tech text-xs px-2 py-1 rounded-sm border transition"
                                                        :class="copied
                                                            ? 'border-emerald-500/50 bg-emerald-950/40 text-emerald-400'
                                                            : 'border-slate-600 bg-slate-800 text-slate-400 hover:border-indigo-500 hover:text-indigo-400'"
                                                    >
                                                        <span x-show="!copied">COPY</span>
                                                        <span x-show="copied">Copied!</span>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="font-mono-tech text-xs text-slate-600 px-3 py-4 text-center">// NO_WALLETS_CONFIGURED</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Transaction Hash --}}
                        <div class="space-y-1.5">
                            <label class="font-mono-tech text-xs text-slate-400 tracking-wider">// TRANSACTION_HASH</label>
                            <input
                                type="text"
                                name="tx_hash"
                                placeholder="0x..."
                                value="{{ old('tx_hash') }}"
                                required
                                class="w-full px-3 py-2.5 bg-slate-800/80 border border-slate-700 rounded-sm font-mono-tech text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/40 transition"
                            />
                            @error('tx_hash')
                                <p class="font-mono-tech text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Proof of Payment --}}
                        <div class="space-y-1.5">
                            <label class="font-mono-tech text-xs text-slate-400 tracking-wider">// PROOF_OF_PAYMENT</label>
                            <div class="relative border border-dashed border-slate-600 rounded-sm p-4 hover:border-indigo-500/60 transition">
                                <input
                                    type="file"
                                    name="proof_img"
                                    accept="image/*"
                                    required
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                />
                                <div class="flex flex-col items-center gap-2 pointer-events-none">
                                    <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="font-mono-tech text-xs text-slate-500">Click to upload screenshot / proof image</span>
                                    <span class="font-mono-tech text-xs text-slate-600">PNG, JPG, WEBP accepted</span>
                                </div>
                            </div>
                            @error('proof_img')
                                <p class="font-mono-tech text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <div class="pt-2">
                            <button
                                type="submit"
                                class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-mono-tech text-sm tracking-widest rounded-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/60"
                            >
                                SUBMIT_DEPOSIT
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- RIGHT COL: INFO CARD --}}
            <div class="lg:col-span-5 space-y-4">
                <div class="relative border border-slate-700/60 bg-slate-900/70 rounded-sm">
                    <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute top-1.5 left-2">+</span>
                    <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute top-1.5 right-2">+</span>
                    <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute bottom-1.5 left-2">+</span>
                    <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute bottom-1.5 right-2">+</span>

                    <div class="border-b border-slate-700/60 px-5 py-3 flex items-center gap-2">
                        <div class="w-1.5 h-1.5 rounded-full bg-amber-500"></div>
                        <span class="font-mono-tech text-xs text-slate-400 tracking-widest">// HOW_TO_DEPOSIT</span>
                    </div>

                    <div class="p-5 space-y-4">
                        <ol class="space-y-3">
                            @foreach([
                                ['01', 'Select your deposit currency from the dropdown above.'],
                                ['02', 'Copy the corresponding admin wallet address from the table.'],
                                ['03', 'Send the exact deposit amount to the copied address.'],
                                ['04', 'Enter the Transaction Hash (TxID) from your wallet/exchange.'],
                                ['05', 'Upload a screenshot as proof of payment.'],
                                ['06', 'Submit and wait for admin confirmation.'],
                            ] as [$step, $text])
                                <li class="flex items-start gap-3">
                                    <span class="font-mono-tech text-xs text-indigo-400 font-semibold flex-shrink-0 mt-0.5">{{ $step }}</span>
                                    <span class="font-mono-tech text-xs text-slate-400 leading-relaxed">{{ $text }}</span>
                                </li>
                            @endforeach
                        </ol>

                        <div class="border-t border-slate-700/40 pt-4 space-y-2.5">
                            <div class="flex items-center justify-between">
                                <span class="font-mono-tech text-xs text-slate-500">// MIN_DEPOSIT</span>
                                <span class="font-mono-tech text-xs text-emerald-400 font-semibold">$10.00</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="font-mono-tech text-xs text-slate-500">// PROCESSING_TIME</span>
                                <span class="font-mono-tech text-xs text-amber-400">2 – 24 hours</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="font-mono-tech text-xs text-slate-500">// VERIFICATION</span>
                                <span class="font-mono-tech text-xs text-slate-300">Admin manual review</span>
                            </div>
                        </div>

                        <div class="border border-amber-500/30 bg-amber-950/20 rounded-sm px-3 py-2.5">
                            <p class="font-mono-tech text-xs text-amber-300/80 leading-relaxed">
                                <span class="text-amber-400 font-semibold">// NOTICE:</span> Always double-check the wallet address before sending. Transactions sent to the wrong address cannot be recovered.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── DEPOSIT HISTORY TABLE ── --}}
        <div class="relative border border-slate-700/60 bg-slate-900/70 rounded-sm">
            <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute top-1.5 left-2">+</span>
            <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute top-1.5 right-2">+</span>
            <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute bottom-1.5 left-2">+</span>
            <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute bottom-1.5 right-2">+</span>

            <div class="border-b border-slate-700/60 px-5 py-3 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-1.5 rounded-full bg-indigo-500"></div>
                    <span class="font-mono-tech text-xs text-slate-400 tracking-widest">// DEPOSIT_HISTORY</span>
                </div>
                <span class="font-mono-tech text-xs text-slate-600">{{ isset($deposits) ? $deposits->count() : 0 }} RECORD(S)</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-700/40 bg-slate-800/40">
                            <th class="font-mono-tech text-xs text-slate-500 px-4 py-3 tracking-wider whitespace-nowrap">// DATE</th>
                            <th class="font-mono-tech text-xs text-slate-500 px-4 py-3 tracking-wider whitespace-nowrap">// AMOUNT</th>
                            <th class="font-mono-tech text-xs text-slate-500 px-4 py-3 tracking-wider whitespace-nowrap">// CURRENCY</th>
                            <th class="font-mono-tech text-xs text-slate-500 px-4 py-3 tracking-wider whitespace-nowrap">// TYPE</th>
                            <th class="font-mono-tech text-xs text-slate-500 px-4 py-3 tracking-wider whitespace-nowrap">// TX_HASH</th>
                            <th class="font-mono-tech text-xs text-slate-500 px-4 py-3 tracking-wider whitespace-nowrap">// STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/30">
                        @forelse($deposits as $deposit)
                            <tr class="hover:bg-slate-800/30 transition">
                                <td class="font-mono-tech text-xs text-slate-400 px-4 py-3 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($deposit->created_at)->format('Y-m-d H:i') }}
                                </td>
                                <td class="font-mono-tech text-xs text-slate-200 px-4 py-3 whitespace-nowrap font-semibold">
                                    ${{ number_format($deposit->amount, 2) }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded-sm bg-indigo-950/60 border border-indigo-700/40 font-mono-tech text-xs text-indigo-300">
                                        {{ $deposit->currency }}
                                    </span>
                                </td>
                                <td class="font-mono-tech text-xs text-slate-400 px-4 py-3 whitespace-nowrap">
                                    {{ $deposit->type ?? 'CRYPTO' }}
                                </td>
                                <td class="font-mono-tech text-xs text-slate-500 px-4 py-3 whitespace-nowrap" title="{{ $deposit->tx_hash }}">
                                    {{ $deposit->tx_hash ? Str::limit($deposit->tx_hash, 16, '...') : '—' }}
                                </td>
                                <td class="px-4 py-3">
                                    @php
                                        $status = strtolower($deposit->status ?? 'pending');
                                        $badgeClass = match($status) {
                                            'approved', 'confirmed', 'completed' => 'bg-emerald-950/60 border-emerald-500/40 text-emerald-400',
                                            'pending', 'processing'              => 'bg-amber-950/60 border-amber-500/40 text-amber-400',
                                            default                              => 'bg-rose-950/60 border-rose-500/40 text-rose-400',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-sm border font-mono-tech text-xs {{ $badgeClass }}">
                                        {{ strtoupper($deposit->status ?? 'PENDING') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-10 text-center">
                                    <span class="font-mono-tech text-xs text-slate-600 tracking-widest">// NO_DEPOSITS_YET</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(isset($deposits) && method_exists($deposits, 'links') && $deposits->hasPages())
                <div class="border-t border-slate-700/40 px-4 py-3">
                    {{ $deposits->links() }}
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
