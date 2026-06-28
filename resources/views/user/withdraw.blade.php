<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-slate-500 font-mono-tech text-xs select-none">+</span>
                <h2 class="font-mono-tech text-sm font-semibold text-rose-400 tracking-widest uppercase">
                    // WITHDRAW_FUNDS
                </h2>
                <span class="text-slate-500 font-mono-tech text-xs select-none">+</span>
            </div>
            <span class="font-mono-tech text-xs text-slate-600">{{ now()->format('Y-m-d H:i:s') }} UTC</span>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-8">

        {{-- ── FLASH MESSAGE ── --}}
        @if (session('status') === 'withdraw-submitted')
            <div class="relative border border-emerald-500/40 bg-emerald-950/40 rounded-sm px-5 py-4 flex items-start gap-3">
                <span class="font-mono-tech text-xs text-slate-500 select-none absolute top-1 left-1">+</span>
                <span class="font-mono-tech text-xs text-slate-500 select-none absolute top-1 right-1">+</span>
                <span class="font-mono-tech text-xs text-slate-500 select-none absolute bottom-1 left-1">+</span>
                <span class="font-mono-tech text-xs text-slate-500 select-none absolute bottom-1 right-1">+</span>
                <svg class="w-4 h-4 text-emerald-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <div>
                    <p class="font-mono-tech text-xs text-emerald-400 font-semibold tracking-wider">// WITHDRAWAL_SUBMITTED</p>
                    <p class="font-mono-tech text-xs text-emerald-300/80 mt-1">Your withdrawal request has been queued for processing. You will be notified upon completion.</p>
                </div>
            </div>
        @endif

        {{-- ── TOP SECTION: 2-COLUMN GRID ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            {{-- LEFT COL: WITHDRAW FORM --}}
            <div class="lg:col-span-7">
                <div class="relative border border-slate-700/60 bg-slate-900/70 rounded-sm">
                    <span class="font-mono-tech text-xs text-rose-500/50 select-none absolute top-1.5 left-2">+</span>
                    <span class="font-mono-tech text-xs text-rose-500/50 select-none absolute top-1.5 right-2">+</span>
                    <span class="font-mono-tech text-xs text-rose-500/50 select-none absolute bottom-1.5 left-2">+</span>
                    <span class="font-mono-tech text-xs text-rose-500/50 select-none absolute bottom-1.5 right-2">+</span>

                    <div class="border-b border-slate-700/60 px-5 py-3 flex items-center gap-2">
                        <div class="w-1.5 h-1.5 rounded-full bg-rose-500"></div>
                        <span class="font-mono-tech text-xs text-slate-400 tracking-widest">// NEW_WITHDRAWAL_REQUEST</span>
                    </div>

                    <form action="{{ route('withdraw.store') }}" method="POST" class="p-5 space-y-5">
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
                                    min="{{ $minWithdrawal ?? 50 }}"
                                    placeholder="0.00"
                                    value="{{ old('amount') }}"
                                    required
                                    class="w-full pl-7 pr-4 py-2.5 bg-slate-800/80 border border-slate-700 rounded-sm font-mono-tech text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:border-rose-500 focus:ring-1 focus:ring-rose-500/40 transition"
                                />
                            </div>
                            <p class="font-mono-tech text-xs text-slate-600">Min. withdrawal: ${{ number_format($minWithdrawal ?? 50, 2) }}</p>
                            @error('amount')
                                <p class="font-mono-tech text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Destination Wallet Address --}}
                        <div class="space-y-1.5">
                            <label class="font-mono-tech text-xs text-slate-400 tracking-wider">// DESTINATION_WALLET_ADDRESS</label>
                            <input
                                type="text"
                                name="wallet_address"
                                placeholder="Enter your receiving wallet address..."
                                value="{{ old('wallet_address') }}"
                                required
                                class="w-full px-3 py-2.5 bg-slate-800/80 border border-slate-700 rounded-sm font-mono-tech text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:border-rose-500 focus:ring-1 focus:ring-rose-500/40 transition"
                            />
                            @error('wallet_address')
                                <p class="font-mono-tech text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Security PIN --}}
                        <div class="space-y-1.5">
                            <label class="font-mono-tech text-xs text-slate-400 tracking-wider">// SECURITY_PIN</label>
                            <input
                                type="password"
                                name="security_pin"
                                maxlength="6"
                                placeholder="••••••"
                                required
                                class="w-full px-3 py-2.5 bg-slate-800/80 border border-slate-700 rounded-sm font-mono-tech text-sm text-slate-200 placeholder-slate-600 tracking-[0.5em] focus:outline-none focus:border-rose-500 focus:ring-1 focus:ring-rose-500/40 transition"
                            />
                            @error('security_pin')
                                <p class="font-mono-tech text-xs text-rose-400">{{ $message }}</p>
                            @enderror

                            {{-- PIN warning --}}
                            <div class="border border-amber-500/30 bg-amber-950/20 rounded-sm px-3 py-2.5 flex items-start gap-2">
                                <svg class="w-3.5 h-3.5 text-amber-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <p class="font-mono-tech text-xs text-amber-300/80 leading-relaxed">
                                    Your Security PIN is required to authorize withdrawals. If your PIN was reset, set a new one in <a href="{{ route('profile.edit') ?? '#' }}" class="text-amber-400 underline underline-offset-2">Settings</a>.
                                </p>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="pt-2">
                            <button
                                type="submit"
                                class="w-full py-2.5 bg-rose-600 hover:bg-rose-500 text-white font-mono-tech text-sm tracking-widest rounded-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-rose-500/60"
                            >
                                SUBMIT_WITHDRAWAL
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- RIGHT COL: BALANCE INFO CARD --}}
            <div class="lg:col-span-5 space-y-4">
                <div class="relative border border-slate-700/60 bg-slate-900/70 rounded-sm">
                    <span class="font-mono-tech text-xs text-rose-500/50 select-none absolute top-1.5 left-2">+</span>
                    <span class="font-mono-tech text-xs text-rose-500/50 select-none absolute top-1.5 right-2">+</span>
                    <span class="font-mono-tech text-xs text-rose-500/50 select-none absolute bottom-1.5 left-2">+</span>
                    <span class="font-mono-tech text-xs text-rose-500/50 select-none absolute bottom-1.5 right-2">+</span>

                    <div class="border-b border-slate-700/60 px-5 py-3 flex items-center gap-2">
                        <div class="w-1.5 h-1.5 rounded-full bg-indigo-500"></div>
                        <span class="font-mono-tech text-xs text-slate-400 tracking-widest">// WALLET_BALANCE</span>
                    </div>

                    <div class="p-5 space-y-5">
                        {{-- Balance Display --}}
                        <div class="text-center py-4 border border-slate-700/40 rounded-sm bg-slate-800/30">
                            <p class="font-mono-tech text-xs text-slate-500 mb-1">// AVAILABLE_BALANCE</p>
                            <p class="font-mono-tech text-3xl font-bold text-emerald-400">
                                ${{ number_format($user->wallet_balance ?? 0, 2) }}
                            </p>
                            <p class="font-mono-tech text-xs text-slate-600 mt-1">USD</p>
                        </div>

                        {{-- Stats --}}
                        <div class="space-y-2.5">
                            <div class="flex items-center justify-between py-2 border-b border-slate-700/30">
                                <span class="font-mono-tech text-xs text-slate-500">// MIN_WITHDRAWAL</span>
                                <span class="font-mono-tech text-xs text-rose-400 font-semibold">${{ number_format($minWithdrawal ?? 50, 2) }}</span>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-slate-700/30">
                                <span class="font-mono-tech text-xs text-slate-500">// WITHDRAWAL_FEE</span>
                                <span class="font-mono-tech text-xs text-amber-400">Platform fee may apply</span>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b border-slate-700/30">
                                <span class="font-mono-tech text-xs text-slate-500">// PROCESSING_TIME</span>
                                <span class="font-mono-tech text-xs text-slate-300">1 – 12 hours</span>
                            </div>
                            <div class="flex items-center justify-between py-2">
                                <span class="font-mono-tech text-xs text-slate-500">// VERIFICATION</span>
                                <span class="font-mono-tech text-xs text-slate-300">PIN required</span>
                            </div>
                        </div>

                        <div class="border border-rose-500/20 bg-rose-950/20 rounded-sm px-3 py-2.5">
                            <p class="font-mono-tech text-xs text-rose-300/80 leading-relaxed">
                                <span class="text-rose-400 font-semibold">// WARNING:</span> Withdrawals are irreversible. Verify your destination address carefully before submitting.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── WITHDRAWAL HISTORY TABLE ── --}}
        <div class="relative border border-slate-700/60 bg-slate-900/70 rounded-sm">
            <span class="font-mono-tech text-xs text-rose-500/50 select-none absolute top-1.5 left-2">+</span>
            <span class="font-mono-tech text-xs text-rose-500/50 select-none absolute top-1.5 right-2">+</span>
            <span class="font-mono-tech text-xs text-rose-500/50 select-none absolute bottom-1.5 left-2">+</span>
            <span class="font-mono-tech text-xs text-rose-500/50 select-none absolute bottom-1.5 right-2">+</span>

            <div class="border-b border-slate-700/60 px-5 py-3 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-1.5 rounded-full bg-rose-500"></div>
                    <span class="font-mono-tech text-xs text-slate-400 tracking-widest">// WITHDRAWAL_HISTORY</span>
                </div>
                <span class="font-mono-tech text-xs text-slate-600">{{ isset($withdrawals) ? $withdrawals->count() : 0 }} RECORD(S)</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-700/40 bg-slate-800/40">
                            <th class="font-mono-tech text-xs text-slate-500 px-4 py-3 tracking-wider whitespace-nowrap">// DATE</th>
                            <th class="font-mono-tech text-xs text-slate-500 px-4 py-3 tracking-wider whitespace-nowrap">// WALLET_ADDRESS</th>
                            <th class="font-mono-tech text-xs text-slate-500 px-4 py-3 tracking-wider whitespace-nowrap">// AMOUNT</th>
                            <th class="font-mono-tech text-xs text-slate-500 px-4 py-3 tracking-wider whitespace-nowrap">// FEE</th>
                            <th class="font-mono-tech text-xs text-slate-500 px-4 py-3 tracking-wider whitespace-nowrap">// STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/30">
                        @forelse($withdrawals as $withdrawal)
                            <tr class="hover:bg-slate-800/30 transition">
                                <td class="font-mono-tech text-xs text-slate-400 px-4 py-3 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($withdrawal->created_at)->format('Y-m-d H:i') }}
                                </td>
                                <td class="font-mono-tech text-xs text-slate-400 px-4 py-3 whitespace-nowrap" title="{{ $withdrawal->wallet_address }}">
                                    {{ Str::limit($withdrawal->wallet_address ?? '—', 20, '...') }}
                                </td>
                                <td class="font-mono-tech text-xs text-slate-200 px-4 py-3 whitespace-nowrap font-semibold">
                                    ${{ number_format($withdrawal->amount, 2) }}
                                </td>
                                <td class="font-mono-tech text-xs text-slate-400 px-4 py-3 whitespace-nowrap">
                                    ${{ number_format($withdrawal->fee ?? 0, 2) }}
                                </td>
                                <td class="px-4 py-3">
                                    @php
                                        $status = strtolower($withdrawal->status ?? 'pending');
                                        $badgeClass = match($status) {
                                            'approved', 'completed', 'paid' => 'bg-emerald-950/60 border-emerald-500/40 text-emerald-400',
                                            'pending', 'processing'         => 'bg-amber-950/60 border-amber-500/40 text-amber-400',
                                            default                         => 'bg-rose-950/60 border-rose-500/40 text-rose-400',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-sm border font-mono-tech text-xs {{ $badgeClass }}">
                                        {{ strtoupper($withdrawal->status ?? 'PENDING') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-10 text-center">
                                    <span class="font-mono-tech text-xs text-slate-600 tracking-widest">// NO_WITHDRAWALS_YET</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(isset($withdrawals) && method_exists($withdrawals, 'links') && $withdrawals->hasPages())
                <div class="border-t border-slate-700/40 px-4 py-3">
                    {{ $withdrawals->links() }}
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
