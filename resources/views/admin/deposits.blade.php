<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-slate-500 font-mono-tech text-xs">+</span>
                <h2 class="font-mono-tech font-bold text-lg text-indigo-400 tracking-widest uppercase">
                    // PENDING_DEPOSITS
                </h2>
                <span class="text-slate-500 font-mono-tech text-xs">+</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded font-mono-tech text-xs bg-amber-900/30 text-amber-300 border border-amber-700/40">
                    ⚠ {{ $deposits->count() }} pending
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

            {{-- Table Header Bar --}}
            <div class="flex items-center justify-between px-4 py-3 bg-slate-800/60 border-b border-slate-700/60">
                <span class="font-mono-tech text-xs text-slate-400 tracking-widest">// DEPOSIT_QUEUE</span>
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded font-mono-tech text-xs bg-indigo-900/40 text-indigo-300 border border-indigo-700/40">
                        deposit
                    </span>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded font-mono-tech text-xs bg-purple-900/40 text-purple-300 border border-purple-700/40">
                        upgrade
                    </span>
                </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-700/60 bg-slate-800/30">
                            <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// ID</th>
                            <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// USER</th>
                            <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// TYPE</th>
                            <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// AMOUNT</th>
                            <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// CURRENCY</th>
                            <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// TARGET_TIER</th>
                            <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// TX_HASH</th>
                            <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// PROOF</th>
                            <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// SUBMITTED</th>
                            <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/80">
                        @forelse($deposits as $deposit)
                            <tr class="hover:bg-slate-800/30 transition-colors">

                                {{-- ID --}}
                                <td class="px-4 py-3 font-mono-tech text-xs text-slate-600 whitespace-nowrap">
                                    #{{ str_pad($deposit->id, 5, '0', STR_PAD_LEFT) }}
                                </td>

                                {{-- User --}}
                                <td class="px-4 py-3 font-mono-tech text-xs text-indigo-400 whitespace-nowrap">
                                    {{ $deposit->user->username ?? $deposit->user->name ?? '—' }}
                                </td>

                                {{-- Type Badge --}}
                                <td class="px-4 py-3 whitespace-nowrap">
                                    @php $type = strtolower($deposit->type ?? 'deposit'); @endphp
                                    @if($type === 'upgrade')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded font-mono-tech text-xs bg-purple-900/40 text-purple-300 border border-purple-700/40">
                                            upgrade
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded font-mono-tech text-xs bg-indigo-900/40 text-indigo-300 border border-indigo-700/40">
                                            deposit
                                        </span>
                                    @endif
                                </td>

                                {{-- Amount --}}
                                <td class="px-4 py-3 font-mono-tech text-xs text-emerald-400 whitespace-nowrap">
                                    ${{ number_format($deposit->amount ?? 0, 2) }}
                                </td>

                                {{-- Currency --}}
                                <td class="px-4 py-3 font-mono-tech text-xs text-slate-300 whitespace-nowrap">
                                    {{ strtoupper($deposit->currency ?? '—') }}
                                </td>

                                {{-- Target Tier --}}
                                <td class="px-4 py-3 font-mono-tech text-xs whitespace-nowrap">
                                    @if($deposit->target_tier ?? $deposit->membership_tier ?? null)
                                        <span class="text-purple-400">
                                            {{ $deposit->target_tier ?? $deposit->membership_tier }}
                                        </span>
                                    @else
                                        <span class="text-slate-600">—</span>
                                    @endif
                                </td>

                                {{-- TX Hash --}}
                                <td class="px-4 py-3 font-mono-tech text-xs text-slate-500 whitespace-nowrap max-w-32">
                                    @if($deposit->transaction_hash ?? null)
                                        <span class="block truncate" title="{{ $deposit->transaction_hash }}">
                                            {{ Str::limit($deposit->transaction_hash, 14, '…') }}
                                        </span>
                                    @else
                                        <span class="text-slate-700">—</span>
                                    @endif
                                </td>

                                {{-- Proof Image --}}
                                <td class="px-4 py-3 whitespace-nowrap">
                                    @if($deposit->proof_image ?? $deposit->proof ?? null)
                                        @php $proofSrc = $deposit->proof_image ?? $deposit->proof; @endphp
                                        <a
                                            href="{{ asset('storage/' . $proofSrc) }}"
                                            target="_blank"
                                            class="inline-block"
                                        >
                                            <img
                                                src="{{ asset('storage/' . $proofSrc) }}"
                                                alt="Proof"
                                                class="w-10 h-10 object-cover rounded border border-slate-700 hover:border-indigo-500 transition-colors"
                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';"
                                            />
                                            <span style="display:none;" class="font-mono-tech text-xs text-indigo-400 underline">view</span>
                                        </a>
                                    @else
                                        <span class="font-mono-tech text-xs text-slate-600">No proof</span>
                                    @endif
                                </td>

                                {{-- Submitted --}}
                                <td class="px-4 py-3 font-mono-tech text-xs text-slate-500 whitespace-nowrap">
                                    {{ $deposit->created_at->format('Y-m-d H:i') }}
                                </td>

                                {{-- Actions --}}
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        {{-- Approve --}}
                                        <form action="{{ route('admin.deposits.approve', $deposit) }}" method="POST">
                                            @csrf
                                            <button
                                                type="submit"
                                                onclick="return confirm('Approve this deposit?')"
                                                class="inline-flex items-center gap-1 px-2.5 py-1 rounded font-mono-tech text-xs bg-emerald-900/30 text-emerald-300 border border-emerald-700/40 hover:bg-emerald-800/40 hover:border-emerald-600/60 transition-colors"
                                            >
                                                ✔ Approve
                                            </button>
                                        </form>

                                        {{-- Reject --}}
                                        <form action="{{ route('admin.deposits.reject', $deposit) }}" method="POST">
                                            @csrf
                                            <button
                                                type="submit"
                                                onclick="return confirm('Reject this deposit?')"
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
                                <td colspan="10" class="px-4 py-16 text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <span class="font-mono-tech text-2xl text-slate-700">✓</span>
                                        <span class="font-mono-tech text-xs text-slate-600">// NO_PENDING_DEPOSITS — queue clear</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($deposits instanceof \Illuminate\Pagination\LengthAwarePaginator && $deposits->hasPages())
                <div class="px-4 py-3 border-t border-slate-700/60 bg-slate-800/30">
                    {{ $deposits->links() }}
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
