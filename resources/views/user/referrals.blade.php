<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <span class="text-slate-500 font-mono-tech text-xs">+</span>
            <h2 class="font-mono-tech text-sm font-semibold text-indigo-400 tracking-widest uppercase">
                // REFERRAL_SYSTEM
            </h2>
            <span class="text-slate-500 font-mono-tech text-xs">+</span>
        </div>
    </x-slot>

    <div class="py-8 px-4 md:px-8 space-y-8">

        {{-- Referral Link + Earnings Card --}}
        <div x-data="{ copied: false, copyLink() { navigator.clipboard.writeText('{{ $referralLink }}').then(() => { this.copied = true; setTimeout(() => this.copied = false, 2500); }); } }"
             class="relative border border-slate-700/60 bg-slate-900/80 rounded-md p-6">

            <span class="absolute top-2 left-2 text-slate-600 font-mono-tech text-xs">+</span>
            <span class="absolute top-2 right-2 text-slate-600 font-mono-tech text-xs">+</span>
            <span class="absolute bottom-2 left-2 text-slate-600 font-mono-tech text-xs">+</span>
            <span class="absolute bottom-2 right-2 text-slate-600 font-mono-tech text-xs">+</span>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

                {{-- Referral Link --}}
                <div class="lg:col-span-2">
                    <p class="font-mono-tech text-xs text-slate-500 tracking-widest uppercase mb-3">// YOUR_REFERRAL_LINK</p>
                    <div class="flex items-stretch gap-2">
                        <div class="flex-1 relative">
                            <input type="text"
                                   readonly
                                   value="{{ $referralLink }}"
                                   class="w-full bg-slate-800/70 border border-slate-600/60 rounded px-4 py-2.5 text-sm font-mono-tech text-indigo-300
                                          focus:outline-none focus:border-indigo-500 cursor-text select-all truncate">
                        </div>
                        <button type="button"
                                @click="copyLink()"
                                class="flex-shrink-0 flex items-center gap-2 px-4 py-2.5 rounded text-sm font-mono-tech font-medium border transition-colors"
                                :class="copied
                                    ? 'bg-emerald-500/10 border-emerald-500/40 text-emerald-400'
                                    : 'bg-indigo-600 border-indigo-500 text-white hover:bg-indigo-500'">
                            <span x-show="!copied">⎘ Copy Link</span>
                            <span x-show="copied" x-cloak>✓ Copied!</span>
                        </button>
                    </div>

                    {{-- Commission Note --}}
                    <div class="mt-4 flex items-start gap-2 border border-indigo-500/25 bg-indigo-500/5 rounded px-4 py-3">
                        <span class="text-indigo-400 font-mono-tech text-sm leading-none mt-0.5">ℹ</span>
                        <p class="text-xs font-mono-tech text-slate-400">
                            Earn <span class="text-indigo-300 font-semibold">5% commission</span> when referred users upgrade their membership.
                            Commissions are credited automatically upon approval.
                        </p>
                    </div>
                </div>

                {{-- Total Earnings --}}
                <div class="relative border border-indigo-500/30 bg-indigo-900/15 rounded px-5 py-5 flex flex-col items-center justify-center text-center gap-2">
                    <span class="absolute top-1.5 left-1.5 text-indigo-800 font-mono-tech text-xs">+</span>
                    <span class="absolute top-1.5 right-1.5 text-indigo-800 font-mono-tech text-xs">+</span>
                    <span class="absolute bottom-1.5 left-1.5 text-indigo-800 font-mono-tech text-xs">+</span>
                    <span class="absolute bottom-1.5 right-1.5 text-indigo-800 font-mono-tech text-xs">+</span>

                    <p class="font-mono-tech text-xs text-slate-500 tracking-widest uppercase">// TOTAL_EARNINGS</p>
                    <p class="font-mono-tech text-3xl font-bold text-emerald-400">
                        ${{ number_format($totalEarnings, 2) }}
                    </p>
                    <p class="font-mono-tech text-xs text-slate-500">
                        from {{ count($referrals) }} referral(s)
                    </p>
                </div>

            </div>
        </div>

        {{-- Referrals Table --}}
        <div class="relative border border-slate-700/60 bg-slate-900/80 rounded-md overflow-hidden">
            <span class="absolute top-2 left-2 text-slate-600 font-mono-tech text-xs z-10">+</span>
            <span class="absolute top-2 right-2 text-slate-600 font-mono-tech text-xs z-10">+</span>
            <span class="absolute bottom-2 left-2 text-slate-600 font-mono-tech text-xs z-10">+</span>
            <span class="absolute bottom-2 right-2 text-slate-600 font-mono-tech text-xs z-10">+</span>

            <div class="px-6 py-4 border-b border-slate-700/60 bg-slate-800/40 flex flex-wrap items-center justify-between gap-3">
                <p class="font-mono-tech text-xs text-slate-400 tracking-widest uppercase">// REFERRED_USERS</p>
                <span class="font-mono-tech text-xs text-slate-600">
                    {{ count($referrals) }} record(s)
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-slate-700/60 bg-slate-800/60">
                            <th class="text-left px-5 py-3 font-mono-tech text-xs text-slate-500 tracking-widest uppercase">#</th>
                            <th class="text-left px-5 py-3 font-mono-tech text-xs text-slate-500 tracking-widest uppercase">Username</th>
                            <th class="text-left px-5 py-3 font-mono-tech text-xs text-slate-500 tracking-widest uppercase">Email</th>
                            <th class="text-left px-5 py-3 font-mono-tech text-xs text-slate-500 tracking-widest uppercase">Date Joined</th>
                            <th class="text-left px-5 py-3 font-mono-tech text-xs text-slate-500 tracking-widest uppercase">Commission Earned</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/30">
                        @forelse ($referrals as $referral)
                            <tr class="{{ $loop->even ? 'bg-slate-800/20' : 'bg-slate-900/40' }} hover:bg-slate-800/50 transition-colors">

                                {{-- # --}}
                                <td class="px-5 py-4">
                                    <span class="font-mono-tech text-xs text-slate-500">
                                        {{ str_pad($loop->iteration, 3, '0', STR_PAD_LEFT) }}
                                    </span>
                                </td>

                                {{-- Username --}}
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded bg-indigo-900/50 border border-indigo-500/30 flex items-center justify-center flex-shrink-0">
                                            <span class="font-mono-tech text-xs text-indigo-400 font-bold uppercase">
                                                {{ substr($referral->referred->username ?? '?', 0, 1) }}
                                            </span>
                                        </div>
                                        <span class="font-mono-tech text-sm text-white">
                                            {{ $referral->referred->username ?? 'Unknown' }}
                                        </span>
                                    </div>
                                </td>

                                {{-- Email --}}
                                <td class="px-5 py-4">
                                    <span class="font-mono-tech text-xs text-slate-400">
                                        {{ $referral->referred->email ?? '—' }}
                                    </span>
                                </td>

                                {{-- Date Joined --}}
                                <td class="px-5 py-4">
                                    <div>
                                        <p class="font-mono-tech text-xs text-white">
                                            {{ \Carbon\Carbon::parse($referral->referred->created_at ?? $referral->created_at)->format('Y-m-d') }}
                                        </p>
                                        <p class="font-mono-tech text-xs text-slate-500 mt-0.5">
                                            {{ \Carbon\Carbon::parse($referral->referred->created_at ?? $referral->created_at)->format('H:i') }}
                                        </p>
                                    </div>
                                </td>

                                {{-- Commission Earned --}}
                                <td class="px-5 py-4">
                                    <span class="font-mono-tech text-sm font-semibold {{ ($referral->commission ?? 0) > 0 ? 'text-emerald-400' : 'text-slate-500' }}">
                                        @if (($referral->commission ?? 0) > 0)
                                            +${{ number_format($referral->commission, 2) }}
                                        @else
                                            $0.00
                                        @endif
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-20 text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <span class="font-mono-tech text-xs text-slate-600 tracking-widest">// NO_REFERRALS_FOUND</span>
                                        <span class="font-mono-tech text-xs text-slate-700">Share your referral link to start earning commissions.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                    {{-- Total Row --}}
                    @if (count($referrals) > 0)
                        <tfoot>
                            <tr class="border-t-2 border-slate-600/60 bg-slate-800/60">
                                <td colspan="4" class="px-5 py-3">
                                    <span class="font-mono-tech text-xs text-slate-400 tracking-widest uppercase">// TOTAL_COMMISSION</span>
                                </td>
                                <td class="px-5 py-3">
                                    <span class="font-mono-tech text-sm font-bold text-emerald-400">
                                        +${{ number_format($totalEarnings, 2) }}
                                    </span>
                                </td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
