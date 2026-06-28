<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-slate-500 font-mono-tech text-xs">+</span>
                <h2 class="font-mono-tech font-bold text-lg text-indigo-400 tracking-widest uppercase">
                    // USER_MANAGEMENT
                </h2>
                <span class="text-slate-500 font-mono-tech text-xs">+</span>
            </div>
            <span class="font-mono-tech text-xs text-slate-500">
                records: <span class="text-indigo-400">{{ $users->count() }}</span>
            </span>
        </div>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-screen-2xl mx-auto space-y-6">

        {{-- Flash: PIN Reset Success --}}
        @if(session('pin-reset-success'))
            <div class="flex items-center gap-3 bg-emerald-900/30 border border-emerald-500/40 rounded-lg px-4 py-3">
                <span class="font-mono-tech text-xs text-emerald-400">✔</span>
                <span class="font-mono-tech text-xs text-emerald-300">{{ session('pin-reset-success') }}</span>
            </div>
        @endif

        {{-- Filter & Search Bar --}}
        <div x-data="{
            search: '',
            statusFilter: '',
            get filtered() {
                const rows = document.querySelectorAll('[data-user-row]');
                rows.forEach(row => {
                    const username = row.dataset.username?.toLowerCase() || '';
                    const email = row.dataset.email?.toLowerCase() || '';
                    const status = row.dataset.status?.toLowerCase() || '';
                    const matchSearch = this.search === '' || username.includes(this.search.toLowerCase()) || email.includes(this.search.toLowerCase());
                    const matchStatus = this.statusFilter === '' || status === this.statusFilter.toLowerCase();
                    row.style.display = (matchSearch && matchStatus) ? '' : 'none';
                });
                return true;
            }
        }" @input.debounce.200ms="filtered" @change="filtered">

            <div class="relative bg-slate-900 border border-slate-700/60 rounded-lg overflow-hidden">
                <div class="absolute -top-1 -left-1 text-slate-600 font-mono-tech text-xs select-none">+</div>
                <div class="absolute -top-1 -right-1 text-slate-600 font-mono-tech text-xs select-none">+</div>
                <div class="absolute -bottom-1 -left-1 text-slate-600 font-mono-tech text-xs select-none">+</div>
                <div class="absolute -bottom-1 -right-1 text-slate-600 font-mono-tech text-xs select-none">+</div>

                {{-- Toolbar --}}
                <div class="flex flex-wrap items-center gap-4 px-4 py-3 bg-slate-800/60 border-b border-slate-700/60">
                    <div class="flex items-center gap-2 flex-1 min-w-48">
                        <span class="font-mono-tech text-xs text-slate-500">// SEARCH</span>
                        <input
                            x-model="search"
                            type="text"
                            placeholder="username or email..."
                            class="flex-1 bg-slate-900 border border-slate-700 rounded px-3 py-1.5 font-mono-tech text-xs text-slate-300 placeholder-slate-600 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30"
                        />
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="font-mono-tech text-xs text-slate-500">// STATUS</span>
                        <select
                            x-model="statusFilter"
                            class="bg-slate-900 border border-slate-700 rounded px-3 py-1.5 font-mono-tech text-xs text-slate-300 focus:outline-none focus:border-indigo-500"
                        >
                            <option value="">ALL</option>
                            <option value="active">ACTIVE</option>
                            <option value="inactive">INACTIVE</option>
                            <option value="suspended">SUSPENDED</option>
                        </select>
                    </div>
                    <div class="font-mono-tech text-xs text-slate-600 ml-auto">
                        total: <span class="text-indigo-400">{{ $users->count() }}</span> users
                    </div>
                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-700/60 bg-slate-800/40">
                                <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// ID</th>
                                <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// USERNAME</th>
                                <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// NAME</th>
                                <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// EMAIL</th>
                                <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// COUNTRY</th>
                                <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// MEMBERSHIP</th>
                                <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// BALANCE</th>
                                <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// STATUS</th>
                                <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// ROLE</th>
                                <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// JOINED</th>
                                <th class="px-4 py-3 font-mono-tech text-xs text-slate-500 tracking-widest whitespace-nowrap">// ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/80">
                            @forelse($users as $user)
                                <tr
                                    data-user-row
                                    data-username="{{ strtolower($user->username ?? '') }}"
                                    data-email="{{ strtolower($user->email ?? '') }}"
                                    data-status="{{ strtolower($user->status ?? 'active') }}"
                                    class="hover:bg-slate-800/40 transition-colors group"
                                >
                                    {{-- ID --}}
                                    <td class="px-4 py-3 font-mono-tech text-xs text-slate-600">
                                        #{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}
                                    </td>

                                    {{-- Username --}}
                                    <td class="px-4 py-3 font-mono-tech text-xs text-indigo-400 whitespace-nowrap">
                                        {{ $user->username ?? '—' }}
                                    </td>

                                    {{-- Name --}}
                                    <td class="px-4 py-3 font-mono-tech text-xs text-slate-300 whitespace-nowrap">
                                        {{ $user->name ?? '—' }}
                                    </td>

                                    {{-- Email --}}
                                    <td class="px-4 py-3 font-mono-tech text-xs text-slate-400 whitespace-nowrap">
                                        {{ $user->email }}
                                    </td>

                                    {{-- Country --}}
                                    <td class="px-4 py-3 font-mono-tech text-xs text-slate-400 whitespace-nowrap">
                                        {{ $user->country ?? '—' }}
                                    </td>

                                    {{-- Membership --}}
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        @if($user->membership)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded font-mono-tech text-xs bg-purple-900/40 text-purple-300 border border-purple-700/40">
                                                {{ $user->membership->name ?? $user->membership }}
                                            </span>
                                        @else
                                            <span class="font-mono-tech text-xs text-slate-600">None</span>
                                        @endif
                                    </td>

                                    {{-- Balance --}}
                                    <td class="px-4 py-3 font-mono-tech text-xs text-emerald-400 whitespace-nowrap">
                                        ${{ number_format($user->balance ?? 0, 2) }}
                                    </td>

                                    {{-- Status Badge --}}
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        @php $status = strtolower($user->status ?? 'active'); @endphp
                                        @if($status === 'active')
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded font-mono-tech text-xs bg-emerald-900/40 text-emerald-300 border border-emerald-700/40">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> ACTIVE
                                            </span>
                                        @elseif($status === 'suspended')
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded font-mono-tech text-xs bg-rose-900/40 text-rose-300 border border-rose-700/40">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-400"></span> SUSPENDED
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded font-mono-tech text-xs bg-slate-800 text-slate-400 border border-slate-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span> INACTIVE
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Role --}}
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        @if(($user->role ?? 'user') === 'admin')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded font-mono-tech text-xs bg-indigo-900/40 text-indigo-300 border border-indigo-700/40">
                                                ADMIN
                                            </span>
                                        @else
                                            <span class="font-mono-tech text-xs text-slate-500">USER</span>
                                        @endif
                                    </td>

                                    {{-- Joined --}}
                                    <td class="px-4 py-3 font-mono-tech text-xs text-slate-500 whitespace-nowrap">
                                        {{ $user->created_at->format('Y-m-d') }}
                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <form
                                            action="{{ route('admin.users.reset-pin', $user) }}"
                                            method="POST"
                                            onsubmit="return confirm('Reset PIN for {{ addslashes($user->username ?? $user->name) }}? This action cannot be undone.');"
                                        >
                                            @csrf
                                            <button
                                                type="submit"
                                                class="inline-flex items-center gap-1 px-2.5 py-1 rounded font-mono-tech text-xs bg-amber-900/30 text-amber-300 border border-amber-700/40 hover:bg-amber-800/40 hover:border-amber-600/60 transition-colors"
                                            >
                                                ⟳ Reset PIN
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="px-4 py-12 text-center font-mono-tech text-xs text-slate-600">
                                        // NO_USERS_FOUND — database empty
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($users instanceof \Illuminate\Pagination\LengthAwarePaginator && $users->hasPages())
                    <div class="px-4 py-3 border-t border-slate-700/60 bg-slate-800/30">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>

    </div>
</x-app-layout>
