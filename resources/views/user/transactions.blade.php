<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div class="flex items-center gap-3">
                <span class="text-slate-500 font-mono-tech text-xs">+</span>
                <h2 class="font-mono-tech text-sm font-semibold text-indigo-400 tracking-widest uppercase">
                    // TRANSACTION_LEDGER
                </h2>
                <span class="text-slate-500 font-mono-tech text-xs">+</span>
            </div>
            {{-- Stats Row --}}
            @php
                $totalDeposits    = $transactions->where('type', 'Deposit')->sum('amount');
                $totalWithdrawals = $transactions->where('type', 'Withdrawal')->sum('amount');
            @endphp
            <div class="flex items-center gap-5">
                <div class="text-right">
                    <p class="font-mono-tech text-xs text-slate-500 leading-none mb-0.5">// TOTAL_DEPOSITS</p>
                    <p class="font-mono-tech text-sm font-semibold text-emerald-400">
                        +${{ number_format($totalDeposits, 2) }}
                    </p>
                </div>
                <div class="w-px h-6 bg-slate-700"></div>
                <div class="text-right">
                    <p class="font-mono-tech text-xs text-slate-500 leading-none mb-0.5">// TOTAL_WITHDRAWALS</p>
                    <p class="font-mono-tech text-sm font-semibold text-rose-400">
                        -${{ number_format($totalWithdrawals, 2) }}
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 px-4 md:px-8">

        <div class="relative border border-slate-700/60 bg-slate-900/80 rounded-md overflow-hidden">
            <span class="absolute top-2 left-2 text-slate-600 font-mono-tech text-xs z-10">+</span>
            <span class="absolute top-2 right-2 text-slate-600 font-mono-tech text-xs z-10">+</span>
            <span class="absolute bottom-2 left-2 text-slate-600 font-mono-tech text-xs z-10">+</span>
            <span class="absolute bottom-2 right-2 text-slate-600 font-mono-tech text-xs z-10">+</span>

            {{-- Table Header Bar --}}
            <div class="px-6 py-4 border-b border-slate-700/60 flex flex-wrap items-center justify-between gap-3 bg-slate-800/40">
                <p class="font-mono-tech text-xs text-slate-400 tracking-widest uppercase">// ALL_TRANSACTIONS</p>
                <span class="font-mono-tech text-xs text-slate-600">
                    {{ $transactions->count() }} record(s)
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-slate-700/60 bg-slate-800/60">
                            <th class="text-left px-5 py-3 font-mono-tech text-xs text-slate-500 tracking-widest uppercase">#</th>
                            <th class="text-left px-5 py-3 font-mono-tech text-xs text-slate-500 tracking-widest uppercase">Date &amp; Time</th>
                            <th class="text-left px-5 py-3 font-mono-tech text-xs text-slate-500 tracking-widest uppercase">Type</th>
                            <th class="text-left px-5 py-3 font-mono-tech text-xs text-slate-500 tracking-widest uppercase">Amount</th>
                            <th class="text-left px-5 py-3 font-mono-tech text-xs text-slate-500 tracking-widest uppercase">Description</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/30">
                        @forelse ($transactions as $index => $transaction)
                            <tr class="{{ $loop->even ? 'bg-slate-800/20' : 'bg-slate-900/40' }} hover:bg-slate-800/50 transition-colors">

                                {{-- # --}}
                                <td class="px-5 py-4">
                                    <span class="font-mono-tech text-xs text-slate-500">
                                        {{ str_pad($loop->iteration, 4, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>

                                {{-- Date & Time --}}
                                <td class="px-5 py-4">
                                    <div>
                                        <p class="font-mono-tech text-xs text-white">
                                            {{ \Carbon\Carbon::parse($transaction->created_at)->format('Y-m-d') }}
                                        </p>
                                        <p class="font-mono-tech text-xs text-slate-500 mt-0.5">
                                            {{ \Carbon\Carbon::parse($transaction->created_at)->format('H:i:s') }}
                                        </p>
                                    </div>
                                </td>

                                {{-- Type Badge --}}
                                <td class="px-5 py-4">
                                    @php
                                        $badgeClasses = match(strtolower($transaction->type)) {
                                            'deposit'    => 'bg-indigo-500/15 text-indigo-300 border-indigo-500/40',
                                            'withdrawal' => 'bg-rose-500/15 text-rose-300 border-rose-500/40',
                                            'upgrade'    => 'bg-purple-500/15 text-purple-300 border-purple-500/40',
                                            'referral'   => 'bg-amber-500/15 text-amber-300 border-amber-500/40',
                                            'profit'     => 'bg-emerald-500/15 text-emerald-300 border-emerald-500/40',
                                            'bonus'      => 'bg-cyan-500/15 text-cyan-300 border-cyan-500/40',
                                            default      => 'bg-slate-700/40 text-slate-400 border-slate-600/40',
                                        };
                                    @endphp
                                    <span class="inline-block font-mono-tech text-xs font-medium px-2 py-0.5 rounded border {{ $badgeClasses }} tracking-wider uppercase">
                                        {{ $transaction->type }}
                                    </span>
                                </td>

                                {{-- Amount --}}
                                <td class="px-5 py-4">
                                    @php
                                        $isPositive = in_array(strtolower($transaction->type), ['deposit', 'profit', 'referral', 'bonus']);
                                        $amountClass = $isPositive ? 'text-emerald-400' : 'text-rose-400';
                                        $amountPrefix = $isPositive ? '+' : '-';
                                    @endphp
                                    <span class="font-mono-tech text-sm font-semibold {{ $amountClass }}">
                                        {{ $amountPrefix }}${{ number_format(abs($transaction->amount), 2) }}
                                    </span>
                                </td>

                                {{-- Description --}}
                                <td class="px-5 py-4">
                                    <span class="font-mono-tech text-xs text-slate-400">
                                        {{ $transaction->description ?? '—' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-20 text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <span class="font-mono-tech text-xs text-slate-600 tracking-widest">// NO_TRANSACTIONS_FOUND</span>
                                        <span class="font-mono-tech text-xs text-slate-700">Your transaction history is empty.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($transactions->hasPages())
                <div class="px-6 py-4 border-t border-slate-700/60 bg-slate-800/30">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
