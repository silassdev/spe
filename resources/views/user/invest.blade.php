<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-slate-500 font-mono-tech text-xs select-none">+</span>
                <h2 class="font-mono-tech text-sm font-semibold text-indigo-400 tracking-widest uppercase">
                    // INVESTMENT_PLANS
                </h2>
                <span class="text-slate-500 font-mono-tech text-xs select-none">+</span>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <span class="font-mono-tech text-xs text-slate-500">// BALANCE:</span>
                    <span class="font-mono-tech text-xs text-emerald-400 font-semibold">${{ number_format(auth()->user()->wallet_balance ?? 0, 2) }}</span>
                </div>
                <span class="font-mono-tech text-xs text-slate-600">{{ now()->format('Y-m-d H:i:s') }} UTC</span>
            </div>
        </div>
    </x-slot>

    {{-- Alpine.js modal state --}}
    <div
        x-data="{
            modalOpen: false,
            selectedTier: { id: null, name: '', price: 0, roi: 0, duration: 0 },
            openModal(tier) {
                this.selectedTier = tier;
                this.modalOpen = true;
            },
            closeModal() {
                this.modalOpen = false;
                this.selectedTier = { id: null, name: '', price: 0, roi: 0, duration: 0 };
            }
        }"
        class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-8"
    >

        {{-- ── FLASH MESSAGE ── --}}
        @if (session('status') === 'plan-activated')
            <div class="relative border border-emerald-500/40 bg-emerald-950/40 rounded-sm px-5 py-4 flex items-start gap-3">
                <span class="font-mono-tech text-xs text-slate-500 select-none absolute top-1 left-1">+</span>
                <span class="font-mono-tech text-xs text-slate-500 select-none absolute top-1 right-1">+</span>
                <span class="font-mono-tech text-xs text-slate-500 select-none absolute bottom-1 left-1">+</span>
                <span class="font-mono-tech text-xs text-slate-500 select-none absolute bottom-1 right-1">+</span>
                <svg class="w-4 h-4 text-emerald-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <div>
                    <p class="font-mono-tech text-xs text-emerald-400 font-semibold tracking-wider">// PLAN_ACTIVATED</p>
                    <p class="font-mono-tech text-xs text-emerald-300/80 mt-1">Your investment plan has been activated. ROI accrual starts immediately.</p>
                </div>
            </div>
        @endif

        {{-- ── TIER CARDS ── --}}
        <div>
            <div class="flex items-center gap-2 mb-4">
                <div class="w-1.5 h-1.5 rounded-full bg-indigo-500"></div>
                <span class="font-mono-tech text-xs text-slate-400 tracking-widest">// SELECT_INVESTMENT_TIER</span>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @forelse($tiers as $index => $tier)
                    <div class="relative border border-slate-700/60 bg-slate-900/70 rounded-sm hover:border-indigo-500/50 transition group">
                        <span class="font-mono-tech text-xs text-indigo-500/40 select-none absolute top-1 left-1.5 group-hover:text-indigo-400/60 transition">+</span>
                        <span class="font-mono-tech text-xs text-indigo-500/40 select-none absolute top-1 right-1.5 group-hover:text-indigo-400/60 transition">+</span>
                        <span class="font-mono-tech text-xs text-indigo-500/40 select-none absolute bottom-1 left-1.5 group-hover:text-indigo-400/60 transition">+</span>
                        <span class="font-mono-tech text-xs text-indigo-500/40 select-none absolute bottom-1 right-1.5 group-hover:text-indigo-400/60 transition">+</span>

                        {{-- Level badge --}}
                        <div class="border-b border-slate-700/60 px-4 py-2.5 flex items-center justify-between">
                            <span class="font-mono-tech text-xs text-slate-500 tracking-widest">// LEVEL_{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="font-mono-tech text-xs px-1.5 py-0.5 rounded-sm bg-indigo-950/60 border border-indigo-700/40 text-indigo-300">T{{ $index + 1 }}</span>
                        </div>

                        <div class="p-4 space-y-3">
                            {{-- Tier name --}}
                            <p class="font-mono-tech text-sm font-bold text-slate-100 tracking-wide">{{ strtoupper($tier->name) }}</p>

                            {{-- Price --}}
                            <div>
                                <p class="font-mono-tech text-xs text-slate-600 mb-0.5">// PRICE</p>
                                <p class="font-mono-tech text-lg font-bold text-indigo-400">${{ number_format($tier->price, 2) }}</p>
                            </div>

                            {{-- ROI --}}
                            <div class="flex items-center justify-between">
                                <span class="font-mono-tech text-xs text-slate-500">// DAILY_ROI</span>
                                <span class="font-mono-tech text-xs text-emerald-400 font-semibold">{{ $tier->daily_roi }}%</span>
                            </div>

                            {{-- Duration --}}
                            <div class="flex items-center justify-between">
                                <span class="font-mono-tech text-xs text-slate-500">// DURATION</span>
                                <span class="font-mono-tech text-xs text-slate-300">{{ $tier->duration }} days</span>
                            </div>

                            {{-- Total ROI estimate --}}
                            <div class="flex items-center justify-between border-t border-slate-700/40 pt-2">
                                <span class="font-mono-tech text-xs text-slate-500">// EST_RETURN</span>
                                <span class="font-mono-tech text-xs text-amber-400 font-semibold">
                                    ${{ number_format($tier->price * ($tier->daily_roi / 100) * $tier->duration, 2) }}
                                </span>
                            </div>

                            {{-- Activate button --}}
                            <button
                                type="button"
                                x-on:click="openModal({
                                    id: {{ $tier->id }},
                                    name: '{{ addslashes($tier->name) }}',
                                    price: {{ $tier->price }},
                                    roi: {{ $tier->daily_roi }},
                                    duration: {{ $tier->duration }}
                                })"
                                class="w-full py-2 mt-1 bg-indigo-600 hover:bg-indigo-500 text-white font-mono-tech text-xs tracking-widest rounded-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/50"
                            >
                                ACTIVATE_PLAN
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-5 py-10 text-center border border-slate-700/40 rounded-sm bg-slate-900/40">
                        <span class="font-mono-tech text-xs text-slate-600 tracking-widest">// NO_TIERS_CONFIGURED</span>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- ── INVESTMENT HISTORY TABLE ── --}}
        <div class="relative border border-slate-700/60 bg-slate-900/70 rounded-sm">
            <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute top-1.5 left-2">+</span>
            <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute top-1.5 right-2">+</span>
            <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute bottom-1.5 left-2">+</span>
            <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute bottom-1.5 right-2">+</span>

            <div class="border-b border-slate-700/60 px-5 py-3 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-1.5 rounded-full bg-indigo-500"></div>
                    <span class="font-mono-tech text-xs text-slate-400 tracking-widest">// MY_INVESTMENTS</span>
                </div>
                <span class="font-mono-tech text-xs text-slate-600">{{ isset($investments) ? $investments->count() : 0 }} RECORD(S)</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-700/40 bg-slate-800/40">
                            <th class="font-mono-tech text-xs text-slate-500 px-4 py-3 tracking-wider whitespace-nowrap">// TIER</th>
                            <th class="font-mono-tech text-xs text-slate-500 px-4 py-3 tracking-wider whitespace-nowrap">// AMOUNT</th>
                            <th class="font-mono-tech text-xs text-slate-500 px-4 py-3 tracking-wider whitespace-nowrap">// PROFIT_EARNED</th>
                            <th class="font-mono-tech text-xs text-slate-500 px-4 py-3 tracking-wider whitespace-nowrap">// DAILY_ROI</th>
                            <th class="font-mono-tech text-xs text-slate-500 px-4 py-3 tracking-wider whitespace-nowrap">// START_DATE</th>
                            <th class="font-mono-tech text-xs text-slate-500 px-4 py-3 tracking-wider whitespace-nowrap">// EXPIRY</th>
                            <th class="font-mono-tech text-xs text-slate-500 px-4 py-3 tracking-wider whitespace-nowrap">// STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/30">
                        @forelse($investments as $investment)
                            <tr class="hover:bg-slate-800/30 transition">
                                <td class="px-4 py-3">
                                    <span class="font-mono-tech text-xs px-1.5 py-0.5 rounded-sm bg-indigo-950/60 border border-indigo-700/40 text-indigo-300">
                                        {{ strtoupper($investment->tier->name ?? 'N/A') }}
                                    </span>
                                </td>
                                <td class="font-mono-tech text-xs text-slate-200 px-4 py-3 whitespace-nowrap font-semibold">
                                    ${{ number_format($investment->amount, 2) }}
                                </td>
                                <td class="font-mono-tech text-xs text-emerald-400 px-4 py-3 whitespace-nowrap font-semibold">
                                    ${{ number_format($investment->profit_earned ?? 0, 2) }}
                                </td>
                                <td class="font-mono-tech text-xs text-slate-300 px-4 py-3 whitespace-nowrap">
                                    {{ $investment->daily_roi ?? ($investment->tier->daily_roi ?? '—') }}%
                                </td>
                                <td class="font-mono-tech text-xs text-slate-400 px-4 py-3 whitespace-nowrap">
                                    {{ $investment->start_date ? \Carbon\Carbon::parse($investment->start_date)->format('Y-m-d') : '—' }}
                                </td>
                                <td class="font-mono-tech text-xs text-slate-400 px-4 py-3 whitespace-nowrap">
                                    {{ $investment->expiry_date ? \Carbon\Carbon::parse($investment->expiry_date)->format('Y-m-d') : '—' }}
                                </td>
                                <td class="px-4 py-3">
                                    @php
                                        $status = strtolower($investment->status ?? 'active');
                                        $badgeClass = match($status) {
                                            'active', 'running'   => 'bg-emerald-950/60 border-emerald-500/40 text-emerald-400',
                                            'completed', 'done'   => 'bg-indigo-950/60 border-indigo-500/40 text-indigo-300',
                                            'pending'             => 'bg-amber-950/60 border-amber-500/40 text-amber-400',
                                            default               => 'bg-rose-950/60 border-rose-500/40 text-rose-400',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-sm border font-mono-tech text-xs {{ $badgeClass }}">
                                        {{ strtoupper($investment->status ?? 'ACTIVE') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-10 text-center">
                                    <span class="font-mono-tech text-xs text-slate-600 tracking-widest">// NO_INVESTMENTS_YET</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(isset($investments) && method_exists($investments, 'links') && $investments->hasPages())
                <div class="border-t border-slate-700/40 px-4 py-3">
                    {{ $investments->links() }}
                </div>
            @endif
        </div>

        {{-- ── ACTIVATION MODAL ── --}}
        <div
            x-show="modalOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm"
            x-cloak
        >
            <div
                x-show="modalOpen"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                x-on:click.outside="closeModal()"
                class="relative w-full max-w-md border border-slate-700/60 bg-slate-900 rounded-sm shadow-2xl"
            >
                {{-- Corner decorations --}}
                <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute top-1.5 left-2">+</span>
                <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute top-1.5 right-2">+</span>
                <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute bottom-1.5 left-2">+</span>
                <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute bottom-1.5 right-2">+</span>

                {{-- Modal header --}}
                <div class="border-b border-slate-700/60 px-5 py-3 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></div>
                        <span class="font-mono-tech text-xs text-slate-400 tracking-widest">// CONFIRM_ACTIVATION</span>
                    </div>
                    <button type="button" x-on:click="closeModal()" class="text-slate-600 hover:text-slate-400 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form action="{{ route('invest.store') }}" method="POST" class="p-5 space-y-5">
                    @csrf

                    {{-- Hidden tier ID --}}
                    <input type="hidden" name="tier_id" x-model="selectedTier.id" />

                    {{-- Confirmation info --}}
                    <div class="border border-indigo-500/20 bg-indigo-950/20 rounded-sm p-4 space-y-2">
                        <p class="font-mono-tech text-xs text-slate-500 tracking-wider">// ACTIVATION_DETAILS</p>
                        <p class="font-mono-tech text-sm text-slate-200">
                            You are activating the
                            <span class="text-indigo-400 font-semibold" x-text="selectedTier.name"></span>
                            Plan for
                            <span class="text-emerald-400 font-semibold">$<span x-text="parseFloat(selectedTier.price).toFixed(2)"></span></span>
                        </p>
                        <div class="grid grid-cols-2 gap-2 pt-1">
                            <div>
                                <p class="font-mono-tech text-xs text-slate-600">// DAILY_ROI</p>
                                <p class="font-mono-tech text-xs text-emerald-400 font-semibold" x-text="selectedTier.roi + '%'"></p>
                            </div>
                            <div>
                                <p class="font-mono-tech text-xs text-slate-600">// DURATION</p>
                                <p class="font-mono-tech text-xs text-slate-300 font-semibold" x-text="selectedTier.duration + ' days'"></p>
                            </div>
                        </div>
                    </div>

                    {{-- Balance deduction notice --}}
                    <div class="border border-amber-500/20 bg-amber-950/15 rounded-sm px-3 py-2.5">
                        <p class="font-mono-tech text-xs text-amber-300/80 leading-relaxed">
                            <span class="text-amber-400 font-semibold">// NOTE:</span> The plan amount will be deducted from your wallet balance immediately upon activation.
                        </p>
                    </div>

                    {{-- Current balance --}}
                    <div class="flex items-center justify-between py-2 border-y border-slate-700/40">
                        <span class="font-mono-tech text-xs text-slate-500">// CURRENT_BALANCE</span>
                        <span class="font-mono-tech text-xs text-emerald-400 font-semibold">${{ number_format(auth()->user()->wallet_balance ?? 0, 2) }}</span>
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
                            class="w-full px-3 py-2.5 bg-slate-800/80 border border-slate-700 rounded-sm font-mono-tech text-sm text-slate-200 placeholder-slate-600 tracking-[0.5em] focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/40 transition"
                        />
                        @error('security_pin')
                            <p class="font-mono-tech text-xs text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Actions --}}
                    <div class="flex gap-3">
                        <button
                            type="button"
                            x-on:click="closeModal()"
                            class="flex-1 py-2.5 border border-slate-600 text-slate-400 hover:text-slate-300 hover:border-slate-500 font-mono-tech text-xs tracking-widest rounded-sm transition"
                        >
                            CANCEL
                        </button>
                        <button
                            type="submit"
                            class="flex-1 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-mono-tech text-xs tracking-widest rounded-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/60"
                        >
                            CONFIRM_ACTIVATE
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
