<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-slate-500 font-mono-tech text-xs select-none">+</span>
                <h2 class="font-mono-tech text-sm font-semibold text-indigo-400 tracking-widest uppercase">
                    // SUPPORT_TICKETS
                </h2>
                <span class="text-slate-500 font-mono-tech text-xs select-none">+</span>
            </div>
            <span class="font-mono-tech text-xs text-slate-600">{{ now()->format('Y-m-d H:i:s') }} UTC</span>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-8">

        {{-- ── FLASH MESSAGE ── --}}
        @if (session('status') === 'ticket-created')
            <div class="relative border border-emerald-500/40 bg-emerald-950/40 rounded-sm px-5 py-4 flex items-start gap-3">
                <span class="font-mono-tech text-xs text-slate-500 select-none absolute top-1 left-1">+</span>
                <span class="font-mono-tech text-xs text-slate-500 select-none absolute top-1 right-1">+</span>
                <span class="font-mono-tech text-xs text-slate-500 select-none absolute bottom-1 left-1">+</span>
                <span class="font-mono-tech text-xs text-slate-500 select-none absolute bottom-1 right-1">+</span>
                <svg class="w-4 h-4 text-emerald-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <div>
                    <p class="font-mono-tech text-xs text-emerald-400 font-semibold tracking-wider">// TICKET_CREATED</p>
                    <p class="font-mono-tech text-xs text-emerald-300/80 mt-1">Your support ticket has been submitted. Our team will respond shortly.</p>
                </div>
            </div>
        @endif

        {{-- ── TOP: CREATE TICKET FORM ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            {{-- FORM --}}
            <div class="lg:col-span-7">
                <div class="relative border border-slate-700/60 bg-slate-900/70 rounded-sm">
                    <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute top-1.5 left-2">+</span>
                    <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute top-1.5 right-2">+</span>
                    <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute bottom-1.5 left-2">+</span>
                    <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute bottom-1.5 right-2">+</span>

                    <div class="border-b border-slate-700/60 px-5 py-3 flex items-center gap-2">
                        <div class="w-1.5 h-1.5 rounded-full bg-indigo-500"></div>
                        <span class="font-mono-tech text-xs text-slate-400 tracking-widest">// NEW_SUPPORT_TICKET</span>
                    </div>

                    <form action="{{ route('support.store') }}" method="POST" class="p-5 space-y-5">
                        @csrf

                        {{-- Subject --}}
                        <div class="space-y-1.5">
                            <label class="font-mono-tech text-xs text-slate-400 tracking-wider">// SUBJECT</label>
                            <input
                                type="text"
                                name="subject"
                                placeholder="Brief description of your issue..."
                                value="{{ old('subject') }}"
                                required
                                maxlength="255"
                                class="w-full px-3 py-2.5 bg-slate-800/80 border border-slate-700 rounded-sm font-mono-tech text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/40 transition"
                            />
                            @error('subject')
                                <p class="font-mono-tech text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Message --}}
                        <div class="space-y-1.5">
                            <label class="font-mono-tech text-xs text-slate-400 tracking-wider">// MESSAGE</label>
                            <textarea
                                name="message"
                                rows="5"
                                placeholder="Describe your issue in detail. Include any relevant transaction IDs, amounts, or error messages..."
                                required
                                class="w-full px-3 py-2.5 bg-slate-800/80 border border-slate-700 rounded-sm font-mono-tech text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/40 transition resize-none"
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <p class="font-mono-tech text-xs text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <div class="pt-1">
                            <button
                                type="submit"
                                class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-mono-tech text-sm tracking-widest rounded-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/60"
                            >
                                OPEN_TICKET
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- INFO PANEL --}}
            <div class="lg:col-span-5">
                <div class="relative border border-slate-700/60 bg-slate-900/70 rounded-sm h-full">
                    <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute top-1.5 left-2">+</span>
                    <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute top-1.5 right-2">+</span>
                    <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute bottom-1.5 left-2">+</span>
                    <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute bottom-1.5 right-2">+</span>

                    <div class="border-b border-slate-700/60 px-5 py-3 flex items-center gap-2">
                        <div class="w-1.5 h-1.5 rounded-full bg-amber-500"></div>
                        <span class="font-mono-tech text-xs text-slate-400 tracking-widest">// SUPPORT_INFO</span>
                    </div>

                    <div class="p-5 space-y-4">
                        <div class="space-y-3">
                            @foreach([
                                ['RESPONSE_TIME', '1 – 24 hours average'],
                                ['SUPPORT_HOURS', '24 / 7 Online'],
                                ['LANGUAGES', 'English'],
                            ] as [$label, $value])
                                <div class="flex items-center justify-between py-2 border-b border-slate-700/30">
                                    <span class="font-mono-tech text-xs text-slate-500">// {{ $label }}</span>
                                    <span class="font-mono-tech text-xs text-slate-300">{{ $value }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="space-y-2">
                            <p class="font-mono-tech text-xs text-slate-500 tracking-wider">// TICKET_STATUS_LEGEND</p>
                            <div class="space-y-2 pt-1">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-sm border bg-amber-950/60 border-amber-500/40 font-mono-tech text-xs text-amber-400">OPEN</span>
                                    <span class="font-mono-tech text-xs text-slate-500">Awaiting admin response</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-sm border bg-indigo-950/60 border-indigo-500/40 font-mono-tech text-xs text-indigo-300">REPLIED</span>
                                    <span class="font-mono-tech text-xs text-slate-500">Admin has responded</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-sm border bg-slate-800/60 border-slate-600/40 font-mono-tech text-xs text-slate-400">CLOSED</span>
                                    <span class="font-mono-tech text-xs text-slate-500">Issue resolved / closed</span>
                                </div>
                            </div>
                        </div>

                        <div class="border border-indigo-500/20 bg-indigo-950/15 rounded-sm px-3 py-2.5">
                            <p class="font-mono-tech text-xs text-indigo-300/80 leading-relaxed">
                                <span class="text-indigo-400 font-semibold">// TIP:</span> Include your transaction ID or deposit/withdrawal reference for faster resolution.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── TICKET HISTORY TABLE ── --}}
        <div class="relative border border-slate-700/60 bg-slate-900/70 rounded-sm">
            <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute top-1.5 left-2">+</span>
            <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute top-1.5 right-2">+</span>
            <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute bottom-1.5 left-2">+</span>
            <span class="font-mono-tech text-xs text-indigo-500/50 select-none absolute bottom-1.5 right-2">+</span>

            <div class="border-b border-slate-700/60 px-5 py-3 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-1.5 rounded-full bg-indigo-500"></div>
                    <span class="font-mono-tech text-xs text-slate-400 tracking-widest">// MY_TICKETS</span>
                </div>
                <span class="font-mono-tech text-xs text-slate-600">{{ isset($tickets) ? $tickets->count() : 0 }} RECORD(S)</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-700/40 bg-slate-800/40">
                            <th class="font-mono-tech text-xs text-slate-500 px-4 py-3 tracking-wider whitespace-nowrap">// DATE</th>
                            <th class="font-mono-tech text-xs text-slate-500 px-4 py-3 tracking-wider whitespace-nowrap">// TICKET_ID</th>
                            <th class="font-mono-tech text-xs text-slate-500 px-4 py-3 tracking-wider">// SUBJECT</th>
                            <th class="font-mono-tech text-xs text-slate-500 px-4 py-3 tracking-wider whitespace-nowrap">// STATUS</th>
                            <th class="font-mono-tech text-xs text-slate-500 px-4 py-3 tracking-wider whitespace-nowrap">// ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/30">
                        @forelse($tickets as $ticket)
                            <tr class="hover:bg-slate-800/30 transition">
                                <td class="font-mono-tech text-xs text-slate-400 px-4 py-3 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($ticket->created_at)->format('Y-m-d H:i') }}
                                </td>
                                <td class="font-mono-tech text-xs text-slate-500 px-4 py-3 whitespace-nowrap">
                                    #{{ str_pad($ticket->id, 5, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="font-mono-tech text-xs text-slate-300 px-4 py-3 max-w-xs">
                                    <span class="truncate block" title="{{ $ticket->subject }}">{{ $ticket->subject }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    @php
                                        $status = strtolower($ticket->status ?? 'open');
                                        $badgeClass = match($status) {
                                            'open'    => 'bg-amber-950/60 border-amber-500/40 text-amber-400',
                                            'replied' => 'bg-indigo-950/60 border-indigo-500/40 text-indigo-300',
                                            'closed'  => 'bg-slate-800/60 border-slate-600/40 text-slate-400',
                                            default   => 'bg-amber-950/60 border-amber-500/40 text-amber-400',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-sm border font-mono-tech text-xs {{ $badgeClass }}">
                                        {{ strtoupper($ticket->status ?? 'OPEN') }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    @if(Route::has('support.show'))
                                        <a
                                            href="{{ route('support.show', $ticket->id) }}"
                                            class="inline-flex items-center gap-1 font-mono-tech text-xs text-indigo-400 hover:text-indigo-300 transition underline underline-offset-2"
                                        >
                                            VIEW
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    @else
                                        <span class="font-mono-tech text-xs text-slate-600">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-10 text-center">
                                    <div class="space-y-2">
                                        <span class="font-mono-tech text-xs text-slate-600 tracking-widest block">// NO_TICKETS_YET</span>
                                        <span class="font-mono-tech text-xs text-slate-700">Submit a ticket above if you need assistance.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(isset($tickets) && method_exists($tickets, 'links') && $tickets->hasPages())
                <div class="border-t border-slate-700/40 px-4 py-3">
                    {{ $tickets->links() }}
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
