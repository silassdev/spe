<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <span class="text-emerald-500 font-mono-tech">//</span>
            <h2 class="font-bold text-xl text-slate-900 dark:text-white leading-tight font-mono-tech uppercase">
                Landlord Overview
            </h2>
        </div>
    </x-slot>

    <!-- Tech readouts -->
    <div class="space-y-6">
        
        <!-- Live status telemetry bar -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl relative overflow-hidden group hover:border-emerald-500/50 transition">
                <div class="absolute top-1 right-1 text-[9px] font-mono-tech text-slate-400 dark:text-slate-600">LN_01</div>
                <p class="text-xs font-mono-tech text-slate-500 uppercase tracking-wider">Properties Managed</p>
                <p class="text-2xl font-black text-slate-900 dark:text-white mt-1">12</p>
                <div class="mt-2 text-[10px] text-emerald-500 font-mono-tech">// SYS_OK</div>
            </div>

            <div class="p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl relative overflow-hidden group hover:border-emerald-500/50 transition">
                <div class="absolute top-1 right-1 text-[9px] font-mono-tech text-slate-400 dark:text-slate-600">LN_02</div>
                <p class="text-xs font-mono-tech text-slate-500 uppercase tracking-wider">Total Units</p>
                <p class="text-2xl font-black text-slate-900 dark:text-white mt-1">48</p>
                <div class="mt-2 text-[10px] text-slate-400 dark:text-slate-500 font-mono-tech">92% Occupied</div>
            </div>

            <div class="p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl relative overflow-hidden group hover:border-emerald-500/50 transition">
                <div class="absolute top-1 right-1 text-[9px] font-mono-tech text-slate-400 dark:text-slate-600">LN_03</div>
                <p class="text-xs font-mono-tech text-slate-500 uppercase tracking-wider">Monthly Collections</p>
                <p class="text-2xl font-black text-slate-900 dark:text-white mt-1">₦4,250,000</p>
                <div class="mt-2 text-[10px] text-emerald-500 font-mono-tech">+14.2% from last month</div>
            </div>

            <div class="p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl relative overflow-hidden group hover:border-emerald-500/50 transition">
                <div class="absolute top-1 right-1 text-[9px] font-mono-tech text-slate-400 dark:text-slate-600">LN_04</div>
                <p class="text-xs font-mono-tech text-slate-500 uppercase tracking-wider">Pending Tasks</p>
                <p class="text-2xl font-black text-rose-500 mt-1">5</p>
                <div class="mt-2 text-[10px] text-rose-400 dark:text-rose-500 font-mono-tech">Requires Attention</div>
            </div>
        </div>

        <!-- Quick Actions & Recent logs -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Quick Actions -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-5 relative overflow-hidden">
                <h3 class="font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                    <span class="text-emerald-500 font-mono-tech">//</span> Operations Menu
                </h3>
                
                <div class="space-y-3">
                    <button class="w-full bg-emerald-500 text-white font-semibold py-2.5 px-4 rounded-lg hover:bg-emerald-400 shadow-md shadow-emerald-500/20 transition font-mono-tech text-xs uppercase">
                        Deploy New Property
                    </button>
                    <button class="w-full border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 font-semibold py-2.5 px-4 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800/40 transition font-mono-tech text-xs uppercase">
                        Generate Monthly Bill
                    </button>
                    <button class="w-full border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 font-semibold py-2.5 px-4 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800/40 transition font-mono-tech text-xs uppercase">
                        Review Maintenance Tickets
                    </button>
                </div>
            </div>

            <!-- Telemetry Graph / Mock Card -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-5 lg:col-span-2 relative overflow-hidden">
                <h3 class="font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                    <span class="text-emerald-500 font-mono-tech">//</span> Collection Health & Growth
                </h3>
                
                <div class="h-44 flex items-end justify-between gap-2 pt-4 border-b border-slate-100 dark:border-slate-800">
                    <div class="w-full bg-slate-100 dark:bg-slate-800/50 rounded-t-lg h-24 hover:bg-emerald-500/20 transition cursor-pointer relative group">
                        <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[9px] px-1 py-0.5 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap">₦3.2M</div>
                        <div class="bg-emerald-500/30 rounded-t-lg h-16 w-full absolute bottom-0"></div>
                        <span class="absolute bottom-[-24px] left-1/2 -translate-x-1/2 text-[9px] font-mono-tech text-slate-400">JAN</span>
                    </div>
                    <div class="w-full bg-slate-100 dark:bg-slate-800/50 rounded-t-lg h-28 hover:bg-emerald-500/20 transition cursor-pointer relative group">
                        <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[9px] px-1 py-0.5 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap">₦3.5M</div>
                        <div class="bg-emerald-500/40 rounded-t-lg h-20 w-full absolute bottom-0"></div>
                        <span class="absolute bottom-[-24px] left-1/2 -translate-x-1/2 text-[9px] font-mono-tech text-slate-400">FEB</span>
                    </div>
                    <div class="w-full bg-slate-100 dark:bg-slate-800/50 rounded-t-lg h-32 hover:bg-emerald-500/20 transition cursor-pointer relative group">
                        <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[9px] px-1 py-0.5 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap">₦3.8M</div>
                        <div class="bg-emerald-500/50 rounded-t-lg h-24 w-full absolute bottom-0"></div>
                        <span class="absolute bottom-[-24px] left-1/2 -translate-x-1/2 text-[9px] font-mono-tech text-slate-400">MAR</span>
                    </div>
                    <div class="w-full bg-slate-100 dark:bg-slate-800/50 rounded-t-lg h-36 hover:bg-emerald-500/20 transition cursor-pointer relative group">
                        <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[9px] px-1 py-0.5 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap">₦4.0M</div>
                        <div class="bg-emerald-500/60 rounded-t-lg h-28 w-full absolute bottom-0"></div>
                        <span class="absolute bottom-[-24px] left-1/2 -translate-x-1/2 text-[9px] font-mono-tech text-slate-400">APR</span>
                    </div>
                    <div class="w-full bg-slate-100 dark:bg-slate-800/50 rounded-t-lg h-40 hover:bg-emerald-500/20 transition cursor-pointer relative group">
                        <div class="absolute -top-6 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[9px] px-1 py-0.5 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap">₦4.2M</div>
                        <div class="bg-emerald-500 rounded-t-lg h-36 w-full absolute bottom-0"></div>
                        <span class="absolute bottom-[-24px] left-1/2 -translate-x-1/2 text-[9px] font-mono-tech text-slate-400">MAY</span>
                    </div>
                </div>
                <div class="h-6"></div>
            </div>
        </div>

        <!-- Recent Logs Table -->
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-5 relative overflow-hidden">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="text-emerald-500 font-mono-tech">//</span> Recent Activity Streams
                </h3>
                <span class="font-mono-tech text-[10px] bg-slate-100 dark:bg-slate-800 px-2 py-0.5 border border-slate-200 dark:border-slate-700/50 rounded text-slate-500">LIVE FEED</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="border-b border-slate-200 dark:border-slate-800 text-slate-500 font-mono-tech">
                            <th class="py-2.5">TIMESTAMP</th>
                            <th class="py-2.5">EVENT / LOG</th>
                            <th class="py-2.5">PROPERTY</th>
                            <th class="py-2.5">STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                        <tr>
                            <td class="py-3 font-mono-tech text-slate-500">17:54:12</td>
                            <td class="py-3 font-semibold text-slate-800 dark:text-slate-200">Rent paid by Tenant: Samuel Obi (Apt 4B)</td>
                            <td class="py-3 text-slate-600 dark:text-slate-400">Allen Gardens</td>
                            <td class="py-3"><span class="px-2 py-0.5 bg-emerald-100 dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/80 rounded font-mono-tech text-[10px] uppercase">SUCCESS</span></td>
                        </tr>
                        <tr>
                            <td class="py-3 font-mono-tech text-slate-500">16:45:00</td>
                            <td class="py-3 font-semibold text-slate-800 dark:text-slate-200">Maintenance Request Logged: Tap Leak (Apt 1A)</td>
                            <td class="py-3 text-slate-600 dark:text-slate-400">Olowu Estates</td>
                            <td class="py-3"><span class="px-2 py-0.5 bg-amber-100 dark:bg-amber-950/40 text-amber-800 dark:text-amber-400 border border-amber-200 dark:border-amber-800/80 rounded font-mono-tech text-[10px] uppercase">OPEN</span></td>
                        </tr>
                        <tr>
                            <td class="py-3 font-mono-tech text-slate-500">14:12:05</td>
                            <td class="py-3 font-semibold text-slate-800 dark:text-slate-200">New Lease Signed: Jessica Nwosu (Apt 2C)</td>
                            <td class="py-3 text-slate-600 dark:text-slate-400">Allen Gardens</td>
                            <td class="py-3"><span class="px-2 py-0.5 bg-blue-100 dark:bg-blue-950/40 text-blue-800 dark:text-blue-400 border border-blue-200 dark:border-blue-800/80 rounded font-mono-tech text-[10px] uppercase">ACTIVE</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
