<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-slate-500 font-mono-tech text-xs">+</span>
                <h2 class="font-mono-tech font-bold text-lg text-indigo-400 tracking-widest uppercase">
                    // SUPPORT_MANAGEMENT
                </h2>
                <span class="text-slate-500 font-mono-tech text-xs">+</span>
            </div>
            <span class="font-mono-tech text-xs text-slate-500">
                tickets: <span class="text-indigo-400">{{ $tickets->count() }}</span>
            </span>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-screen-2xl mx-auto space-y-6">

        {{-- Flash: Ticket Replied --}}
        @if(session('ticket-replied'))
            <div class="flex items-center gap-3 bg-emerald-900/30 border border-emerald-500/40 rounded-lg px-4 py-3">
                <span class="font-mono-tech text-xs text-emerald-400">✔</span>
                <span class="font-mono-tech text-xs text-emerald-300">{{ session('ticket-replied') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="flex items-center gap-3 bg-rose-900/30 border border-rose-500/40 rounded-lg px-4 py-3">
                <span class="font-mono-tech text-xs text-rose-400">✖</span>
                <span class="font-mono-tech text-xs text-rose-300">{{ session('error') }}</span>
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

        {{-- Table Container --}}
        <div class="relative bg-slate-900 border border-slate-700/60 rounded-lg overflow-hidden">
            <div class="absolute -top-1 -left-1 text-slate-600 font-mono-tech text-xs select-none">+</div>
            <div class="absolute -top-1 -right-1 text-slate-600 font-mono-tech text-xs select-none">+</div>
            <div class="absolute -bottom-1 -left-1 text-slate-600 font-mono-tech text-xs select-none">+</div>
            <div class="absolute -bottom-1 -right-1 text-slate-600 font-mono-tech text-xs select-none">+</div>

            {{-- Header Bar --}}
            <div class="flex items-center justify-between px-4 py-3 bg-slate-800/60 border-b border-slate-700/60">
                <span class="font-mono-tech text-xs text-slate-400 tracking-widest">// TICKET_QUEUE</span>
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded font-mono-tech text-xs bg-amber-900/30 text-amber-300 border border-amber-700/40">
                        open
                    </span>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded font-mono-tech text-xs bg-emerald-900/30 text-emerald-300 border border-emerald-700/40">
                        replied
                    </span>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded font-mono-tech text-xs bg-slate-800 text-slate-400 border border-slate-700">
                        closed
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
                            <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// SUBJECT</th>
                            <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// MESSAGE</th>
                            <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// STATUS</th>
                            <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// SUBMITTED</th>
                            <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets as $ticket)
                            <tr
                                x-data="{ replyOpen: false }"
                                class="border-b border-slate-800/80 hover:bg-slate-800/20 transition-colors"
                            >
                                {{-- Main Row --}}
                                <td class="px-4 py-3 font-mono-tech text-xs text-slate-600 whitespace-nowrap align-top">
                                    #{{ str_pad($ticket->id, 5, '0', STR_PAD_LEFT) }}
                                </td>

                                <td class="px-4 py-3 font-mono-tech text-xs text-indigo-400 whitespace-nowrap align-top">
                                    {{ $ticket->user->username ?? $ticket->user->name ?? '—' }}
                                </td>

                                <td class="px-4 py-3 font-mono-tech text-xs text-slate-300 align-top max-w-xs">
                                    <span class="block truncate max-w-48" title="{{ $ticket->subject ?? '' }}">
                                        {{ $ticket->subject ?? '—' }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 font-mono-tech text-xs text-slate-400 align-top max-w-xs">
                                    <span class="block line-clamp-2 max-w-56" title="{{ $ticket->message ?? '' }}">
                                        {{ Str::limit($ticket->message ?? '—', 80, '…') }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 whitespace-nowrap align-top">
                                    @php $status = strtolower($ticket->status ?? 'open'); @endphp
                                    @if($status === 'open' || $status === 'pending')
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded font-mono-tech text-xs bg-amber-900/40 text-amber-300 border border-amber-700/40">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span> OPEN
                                        </span>
                                    @elseif($status === 'replied')
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded font-mono-tech text-xs bg-emerald-900/40 text-emerald-300 border border-emerald-700/40">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> REPLIED
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded font-mono-tech text-xs bg-slate-800 text-slate-400 border border-slate-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span> CLOSED
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 font-mono-tech text-xs text-slate-500 whitespace-nowrap align-top">
                                    {{ $ticket->created_at->format('Y-m-d H:i') }}
                                </td>

                                <td class="px-4 py-3 whitespace-nowrap align-top">
                                    <button
                                        type="button"
                                        @click="replyOpen = !replyOpen"
                                        :class="replyOpen
                                            ? 'bg-indigo-700/40 text-indigo-200 border-indigo-500/60'
                                            : 'bg-indigo-900/30 text-indigo-300 border-indigo-700/40 hover:bg-indigo-800/40'"
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded font-mono-tech text-xs border transition-colors"
                                    >
                                        <span x-text="replyOpen ? '▲ CLOSE' : '▼ REPLY'"></span>
                                    </button>
                                </td>
                            </tr>

                            {{-- Inline Reply Row --}}
                            <tr
                                x-data="{ replyOpen: false }"
                                x-show="$el.previousElementSibling.__x.$data.replyOpen"
                                class="border-b border-slate-800 bg-slate-800/20"
                            >
                                <td colspan="7" class="px-4 py-4">
                                    {{-- Previous Messages --}}
                                    @if($ticket->reply ?? null)
                                        <div class="mb-3 bg-slate-800/50 border border-slate-700/60 rounded p-3 space-y-1">
                                            <span class="font-mono-tech text-xs text-slate-500 tracking-widest">// PREVIOUS_REPLY</span>
                                            <p class="font-mono-tech text-xs text-slate-300 mt-1">{{ $ticket->reply }}</p>
                                        </div>
                                    @endif

                                    {{-- Reply Form --}}
                                    <form action="{{ route('admin.support.reply', $ticket) }}" method="POST" class="space-y-3">
                                        @csrf
                                        <div>
                                            <label class="block font-mono-tech text-xs text-slate-500 tracking-widest mb-1.5">
                                                // ADMIN_REPLY — ticket #{{ str_pad($ticket->id, 5, '0', STR_PAD_LEFT) }}
                                            </label>
                                            <textarea
                                                name="reply"
                                                rows="4"
                                                placeholder="Type your reply..."
                                                required
                                                class="w-full bg-slate-800 border border-slate-700 rounded px-3 py-2.5 font-mono-tech text-xs text-slate-200 placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30 transition-colors resize-y"
                                            >{{ old('reply') }}</textarea>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <button
                                                type="submit"
                                                class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 rounded font-mono-tech text-xs text-white tracking-widest transition-colors"
                                            >
                                                <span>→</span> SEND_REPLY
                                            </button>
                                            <span class="font-mono-tech text-xs text-slate-600">// ticket will be marked as replied</span>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-16 text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <span class="font-mono-tech text-2xl text-slate-700">✓</span>
                                        <span class="font-mono-tech text-xs text-slate-600">// NO_OPEN_TICKETS — all resolved</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($tickets instanceof \Illuminate\Pagination\LengthAwarePaginator && $tickets->hasPages())
                <div class="px-4 py-3 border-t border-slate-700/60 bg-slate-800/30">
                    {{ $tickets->links() }}
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
