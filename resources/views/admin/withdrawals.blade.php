<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-slate-500 font-mono-tech text-xs">+</span>
                <h2 class="font-mono-tech font-bold text-lg text-indigo-400 tracking-widest uppercase">
                    // PENDING_WITHDRAWALS
                </h2>
                <span class="text-slate-500 font-mono-tech text-xs">+</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded font-mono-tech text-xs bg-amber-900/30 text-amber-300 border border-amber-700/40">
                    ⚠ {{ $withdrawals->count() }} pending
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-screen-2xl mx-auto space-y-6">

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="flex items-center gap-3 bg-emerald-900/30 border border-emerald-500/40 rounded-lg px-4 py-3">
                <span class="font-mono-tech text-xs text-emerald-400">✔</span>
                <span class="font-mono-tech text-xs text-emerald-300">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="flex items-center gap-3 bg-rose-900/30 border border-rose-500/40 rounded-lg px-4 py-3">
                <span class="font-mono-tech text-xs text-rose-400">✖</span>
                <span class="font-mono-tech text-xs text-rose-300">{{ session('error') }}</span>
            </div>
        @endif
        @if(session('approve-success'))
            <div class="flex items-center gap-3 bg-emerald-900/30 border border-emerald-500/40 rounded-lg px-4 py-3">
                <span class="font-mono-tech text-xs text-emerald-400">✔</span>
                <span class="font-mono-tech text-xs text-emerald-300">{{ session('approve-success') }}</span>
            </div>
        @endif
        @if(session('reject-success'))
            <div class="flex items-center gap-3 bg-rose-900/30 border border-rose-500/40 rounded-lg px-4 py-3">
                <span class="font-mono-tech text-xs text-rose-400">✖</span>
                <span class="font-mono-tech text-xs text-rose-300">{{ session('reject-success') }}</span>
            </div>
        @endif

        {{-- Table Container --}}
        <div class="relative bg-slate-900 border border-slate-700/60 rounded-lg overflow-hidden">
            <div class="absolute -top-1 -left-1 text-slate-600 font-mono-tech text-xs select-none">+</div>
            <div class="absolute -top-1 -right-1 text-slate-600 font-mono-tech text-xs select-none">+</div>
            <div class="absolute -bottom-1 -left-1 text-slate-600 font-mono-tech text-xs select-none">+</div>
            <div class="absolute -bottom-1 -right-1 text-slate-600 font-mono-tech text-xs select-none">+</div>

            {{-- Header Bar --}}
            <div class="flex items-center justify-between px-4 py-3 bg-slate-800/60 border-b border-slate-700/60">
                <span class="font-mono-tech text-xs text-slate-400 tracking-widest">// WITHDRAWAL_QUEUE</span>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    <span class="font-mono-tech text-xs text-amber-400">AWAITING REVIEW</span>
                </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-700/60 bg-slate-800/30">
                            <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// ID</th>
                            <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// USER</th>
                            <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// WALLET_ADDRESS</th>
                            <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// AMOUNT</th>
                            <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// FEE</th>
                            <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// SUBMITTED</th>
                            <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/80">
                        @forelse($withdrawals as $withdrawal)
                            <tr class="hover:bg-slate-800/30 transition-colors">

                                {{-- ID --}}
                                <td class="px-4 py-3 font-mono-tech text-xs text-slate-600 whitespace-nowrap">
                                    #{{ str_pad($withdrawal->id, 5, '0', STR_PAD_LEFT) }}
                                </td>

                                {{-- User --}}
                                <td class="px-4 py-3 font-mono-tech text-xs text-indigo-400 whitespace-nowrap">
                                    {{ $withdrawal->user->username ?? $withdrawal->user->name ?? '—' }}
                                </td>

                                {{-- Wallet Address (truncated) --}}
                                <td class="px-4 py-3 whitespace-nowrap max-w-xs">
                                    @php $addr = $withdrawal->wallet_address ?? $withdrawal->address ?? '—'; @endphp
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="font-mono-tech text-xs text-slate-400 block truncate max-w-40"
                                            title="{{ $addr }}"
                                        >
                                            {{ strlen($addr) > 20 ? substr($addr, 0, 10) . '…' . substr($addr, -8) : $addr }}
                                        </span>
                                        @if($addr !== '—')
                                            <button
                                                onclick="navigator.clipboard.writeText('{{ addslashes($addr) }}')"
                                                class="font-mono-tech text-xs text-slate-600 hover:text-indigo-400 transition-colors shrink-0"
                                                title="Copy address"
                                            >⧉</button>
                                        @endif
                                    </div>
                                </td>

                                {{-- Amount --}}
                                <td class="px-4 py-3 font-mono-tech text-xs text-emerald-400 whitespace-nowrap">
                                    ${{ number_format($withdrawal->amount ?? 0, 2) }}
                                </td>

                                {{-- Fee --}}
                                <td class="px-4 py-3 font-mono-tech text-xs text-rose-400 whitespace-nowrap">
                                    @if(($withdrawal->fee ?? 0) > 0)
                                        ${{ number_format($withdrawal->fee, 2) }}
                                    @else
                                        <span class="text-slate-600">—</span>
                                    @endif
                                </td>

                                {{-- Submitted --}}
                                <td class="px-4 py-3 font-mono-tech text-xs text-slate-500 whitespace-nowrap">
                                    {{ $withdrawal->created_at->format('Y-m-d H:i') }}
                                </td>

                                {{-- Actions --}}
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        {{-- Approve --}}
                                        <form action="{{ route('admin.withdrawals.approve', $withdrawal) }}" method="POST">
                                            @csrf
                                            <button
                                                type="submit"
                                                onclick="return confirm('Approve withdrawal of ${{ number_format($withdrawal->amount ?? 0, 2) }} for {{ addslashes($withdrawal->user->username ?? '') }}?')"
                                                class="inline-flex items-center gap-1 px-2.5 py-1 rounded font-mono-tech text-xs bg-emerald-900/30 text-emerald-300 border border-emerald-700/40 hover:bg-emerald-800/40 hover:border-emerald-600/60 transition-colors"
                                            >
                                                ✔ Approve
                                            </button>
                                        </form>

                                        {{-- Reject --}}
                                        <form action="{{ route('admin.withdrawals.reject', $withdrawal) }}" method="POST">
                                            @csrf
                                            <button
                                                type="submit"
                                                onclick="return confirm('Reject this withdrawal request?')"
                                                class="inline-flex items-center gap-1 px-2.5 py-1 rounded font-mono-tech text-xs bg-rose-900/30 text-rose-300 border border-rose-700/40 hover:bg-rose-800/40 hover:border-rose-600/60 transition-colors"
                                            >
                                                ✖ Reject
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-16 text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <span class="font-mono-tech text-2xl text-slate-700">✓</span>
                                        <span class="font-mono-tech text-xs text-slate-600">// NO_PENDING_WITHDRAWALS — queue clear</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($withdrawals instanceof \Illuminate\Pagination\LengthAwarePaginator && $withdrawals->hasPages())
                <div class="px-4 py-3 border-t border-slate-700/60 bg-slate-800/30">
                    {{ $withdrawals->links() }}
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
