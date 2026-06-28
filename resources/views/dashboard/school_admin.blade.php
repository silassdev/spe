<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <span class="text-purple-500 font-mono-tech">//</span>
            <h2 class="font-bold text-xl text-slate-900 dark:text-white leading-tight font-mono-tech uppercase">
                School Boarding Panel
            </h2>
        </div>
    </x-slot>

    <!-- Tech readouts -->
    <div class="space-y-6">
        
        <!-- Live status telemetry bar -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl relative overflow-hidden group hover:border-purple-500/50 transition">
                <div class="absolute top-1 right-1 text-[9px] font-mono-tech text-slate-400 dark:text-slate-600">SCH_01</div>
                <p class="text-xs font-mono-tech text-slate-500 uppercase tracking-wider">Hostel Blocks</p>
                <p class="text-2xl font-black text-slate-900 dark:text-white mt-1">4</p>
                <div class="mt-2 text-[10px] text-purple-500 font-mono-tech">// BLK_ONLINE</div>
            </div>

            <div class="p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl relative overflow-hidden group hover:border-purple-500/50 transition">
                <div class="absolute top-1 right-1 text-[9px] font-mono-tech text-slate-400 dark:text-slate-600">SCH_02</div>
                <p class="text-xs font-mono-tech text-slate-500 uppercase tracking-wider">Boarding Students</p>
                <p class="text-2xl font-black text-slate-900 dark:text-white mt-1">320</p>
                <div class="mt-2 text-[10px] text-slate-400 dark:text-slate-500 font-mono-tech">98% Room Occupancy</div>
            </div>

            <div class="p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl relative overflow-hidden group hover:border-purple-500/50 transition">
                <div class="absolute top-1 right-1 text-[9px] font-mono-tech text-slate-400 dark:text-slate-600">SCH_03</div>
                <p class="text-xs font-mono-tech text-slate-500 uppercase tracking-wider">Dorm Fee Collection</p>
                <p class="text-2xl font-black text-slate-900 dark:text-white mt-1">85%</p>
                <div class="mt-2 text-[10px] text-purple-500 font-mono-tech">₦12.5M collected</div>
            </div>

            <div class="p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl relative overflow-hidden group hover:border-purple-500/50 transition">
                <div class="absolute top-1 right-1 text-[9px] font-mono-tech text-slate-400 dark:text-slate-600">SCH_04</div>
                <p class="text-xs font-mono-tech text-slate-500 uppercase tracking-wider">Active Wardens</p>
                <p class="text-2xl font-black text-slate-900 dark:text-white mt-1">8</p>
                <div class="mt-2 text-[10px] text-emerald-500 font-mono-tech">On-Duty</div>
            </div>
        </div>

        <!-- Middle Columns -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Boarding Operations -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-5 relative overflow-hidden">
                <h3 class="font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                    <span class="text-purple-500 font-mono-tech">//</span> Administrative Actions
                </h3>
                
                <div class="space-y-3">
                    <button class="w-full bg-purple-600 text-white font-semibold py-2.5 px-4 rounded-lg hover:bg-purple-500 shadow-md shadow-purple-500/20 transition font-mono-tech text-xs uppercase">
                        Allocate Bed Spaces
                    </button>
                    <button class="w-full border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 font-semibold py-2.5 px-4 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800/40 transition font-mono-tech text-xs uppercase">
                        Record Termly Fee Payments
                    </button>
                    <button class="w-full border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 font-semibold py-2.5 px-4 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800/40 transition font-mono-tech text-xs uppercase">
                        Audit Dorm Inventories
                    </button>
                </div>
            </div>

            <!-- Block Allocations -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-5 lg:col-span-2 relative overflow-hidden">
                <h3 class="font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                    <span class="text-purple-500 font-mono-tech">//</span> Hostel Occupancy Density
                </h3>
                
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-xs font-semibold mb-1">
                            <span>Nelson Mandela Block (Male Senior)</span>
                            <span class="font-mono-tech">96/100 Beds occupied</span>
                        </div>
                        <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-2">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: 96%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-xs font-semibold mb-1">
                            <span>Funmilayo Ransome-Kuti Block (Female Senior)</span>
                            <span class="font-mono-tech">118/120 Beds occupied</span>
                        </div>
                        <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-2">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: 98%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-xs font-semibold mb-1">
                            <span>Nnamdi Azikiwe Block (Junior Dorms)</span>
                            <span class="font-mono-tech">72/100 Beds occupied</span>
                        </div>
                        <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-2">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: 72%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Attendance and logs -->
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-5 relative overflow-hidden">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="text-purple-500 font-mono-tech">//</span> Dormitory Log Logs
                </h3>
                <span class="font-mono-tech text-[10px] bg-slate-100 dark:bg-slate-800 px-2 py-0.5 border border-slate-200 dark:border-slate-700/50 rounded text-slate-500">REALTIME MONITOR</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="border-b border-slate-200 dark:border-slate-800 text-slate-500 font-mono-tech">
                            <th class="py-2.5">TIME</th>
                            <th class="py-2.5">STUDENT ID</th>
                            <th class="py-2.5">STUDENT NAME</th>
                            <th class="py-2.5">BLOCK / ROOM</th>
                            <th class="py-2.5">ACTION STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                        <tr>
                            <td class="py-3 font-mono-tech text-slate-500">17:40:11</td>
                            <td class="py-3 font-mono-tech">STU-2026-092</td>
                            <td class="py-3 font-semibold text-slate-800 dark:text-slate-200">Emeka Anyanwu</td>
                            <td class="py-3 text-slate-600 dark:text-slate-400">Mandela Block Room 12</td>
                            <td class="py-3"><span class="px-2 py-0.5 bg-emerald-100 dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/80 rounded font-mono-tech text-[10px] uppercase">CHECKED IN</span></td>
                        </tr>
                        <tr>
                            <td class="py-3 font-mono-tech text-slate-500">15:10:00</td>
                            <td class="py-3 font-mono-tech">STU-2026-114</td>
                            <td class="py-3 font-semibold text-slate-800 dark:text-slate-200">Amina Yusuf</td>
                            <td class="py-3 text-slate-600 dark:text-slate-400">Ransome-Kuti Room 3B</td>
                            <td class="py-3"><span class="px-2 py-0.5 bg-rose-100 dark:bg-rose-950/40 text-rose-800 dark:text-rose-400 border border-rose-200 dark:border-rose-800/80 rounded font-mono-tech text-[10px] uppercase">EXEAT GRANTED</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
