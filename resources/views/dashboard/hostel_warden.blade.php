<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <span class="text-amber-500 font-mono-tech">//</span>
            <h2 class="font-bold text-xl text-slate-900 dark:text-white leading-tight font-mono-tech uppercase">
                Hostel Warden Command
            </h2>
        </div>
    </x-slot>

    <!-- Tech readouts -->
    <div class="space-y-6">
        
        <!-- Live status telemetry bar -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl relative overflow-hidden group hover:border-amber-500/50 transition">
                <div class="absolute top-1 right-1 text-[9px] font-mono-tech text-slate-400 dark:text-slate-600">WD_01</div>
                <p class="text-xs font-mono-tech text-slate-500 uppercase tracking-wider">Active Bed Spaces</p>
                <p class="text-2xl font-black text-slate-900 dark:text-white mt-1">120</p>
                <div class="mt-2 text-[10px] text-amber-500 font-mono-tech">// SYS_NOMINAL</div>
            </div>

            <div class="p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl relative overflow-hidden group hover:border-amber-500/50 transition">
                <div class="absolute top-1 right-1 text-[9px] font-mono-tech text-slate-400 dark:text-slate-600">WD_02</div>
                <p class="text-xs font-mono-tech text-slate-500 uppercase tracking-wider">Registered Occupants</p>
                <p class="text-2xl font-black text-slate-900 dark:text-white mt-1">112</p>
                <div class="mt-2 text-[10px] text-slate-400 dark:text-slate-500 font-mono-tech">8 Vacancies remaining</div>
            </div>

            <div class="p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl relative overflow-hidden group hover:border-amber-500/50 transition">
                <div class="absolute top-1 right-1 text-[9px] font-mono-tech text-slate-400 dark:text-slate-600">WD_03</div>
                <p class="text-xs font-mono-tech text-slate-500 uppercase tracking-wider">Maintenance Reports</p>
                <p class="text-2xl font-black text-amber-500 mt-1">3</p>
                <div class="mt-2 text-[10px] text-amber-500 font-mono-tech">1 Urgent, 2 Routine</div>
            </div>

            <div class="p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl relative overflow-hidden group hover:border-amber-500/50 transition">
                <div class="absolute top-1 right-1 text-[9px] font-mono-tech text-slate-400 dark:text-slate-600">WD_04</div>
                <p class="text-xs font-mono-tech text-slate-500 uppercase tracking-wider">Curfew Status</p>
                <p class="text-2xl font-black text-emerald-500 mt-1">CLOSED</p>
                <div class="mt-2 text-[10px] text-slate-400 dark:text-slate-500 font-mono-tech">Effective 22:00 WAT</div>
            </div>
        </div>

        <!-- Middle Columns -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Warden Operations -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-5 relative overflow-hidden">
                <h3 class="font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                    <span class="text-amber-500 font-mono-tech">//</span> Warden Commands
                </h3>
                
                <div class="space-y-3">
                    <button class="w-full bg-amber-500 text-slate-950 font-bold py-2.5 px-4 rounded-lg hover:bg-amber-400 shadow-md shadow-amber-500/25 transition font-mono-tech text-xs uppercase">
                        Assign Room Keycard
                    </button>
                    <button class="w-full border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 font-semibold py-2.5 px-4 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800/40 transition font-mono-tech text-xs uppercase">
                        Log Incident report
                    </button>
                    <button class="w-full border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 font-semibold py-2.5 px-4 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800/40 transition font-mono-tech text-xs uppercase">
                        Run Room Attendance Check
                    </button>
                </div>
            </div>

            <!-- Recent incident tickets -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-5 lg:col-span-2 relative overflow-hidden">
                <h3 class="font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                    <span class="text-amber-500 font-mono-tech">//</span> Open Incident Registers
                </h3>
                
                <div class="space-y-3">
                    <div class="p-3 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800/60 rounded-lg flex justify-between items-center hover:border-amber-500/30 transition">
                        <div>
                            <span class="text-[9px] font-mono-tech text-rose-500 uppercase tracking-widest">[ URGENT ]</span>
                            <h4 class="text-xs font-bold text-slate-800 dark:text-slate-200 mt-0.5">Water Leakage Nelson Mandela Block Room 5</h4>
                            <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-0.5">Logged by Warden James // Assigned to plumber</p>
                        </div>
                        <span class="text-xs font-mono-tech text-slate-500">2h ago</span>
                    </div>

                    <div class="p-3 bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800/60 rounded-lg flex justify-between items-center hover:border-amber-500/30 transition">
                        <div>
                            <span class="text-[9px] font-mono-tech text-amber-500 uppercase tracking-widest">[ ROUTINE ]</span>
                            <h4 class="text-xs font-bold text-slate-800 dark:text-slate-200 mt-0.5">Light Bulb Replacement Block B Hallway</h4>
                            <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-0.5">Logged by Student Rep // Pending execution</p>
                        </div>
                        <span class="text-xs font-mono-tech text-slate-500">6h ago</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Occupancy Log -->
        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-5 relative overflow-hidden">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="text-amber-500 font-mono-tech">//</span> Active Occupant Telemetry
                </h3>
                <span class="font-mono-tech text-[10px] bg-slate-100 dark:bg-slate-800 px-2 py-0.5 border border-slate-200 dark:border-slate-700/50 rounded text-slate-500">WARDEN_LIVE</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="border-b border-slate-200 dark:border-slate-800 text-slate-500 font-mono-tech">
                            <th class="py-2.5">OCCUPANT ID</th>
                            <th class="py-2.5">FULL NAME</th>
                            <th class="py-2.5">ROOM ALLOCATION</th>
                            <th class="py-2.5">CHECK-IN DATE</th>
                            <th class="py-2.5">GATEWAY LOCK</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                        <tr>
                            <td class="py-3 font-mono-tech">OCC-4022</td>
                            <td class="py-3 font-semibold text-slate-800 dark:text-slate-200">Precious Adeleke</td>
                            <td class="py-3 text-slate-600 dark:text-slate-400">Block C Room 15 (Bed 2)</td>
                            <td class="py-3 font-mono-tech text-slate-500">2026-05-10</td>
                            <td class="py-3"><span class="px-2 py-0.5 bg-emerald-100 dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/80 rounded font-mono-tech text-[10px] uppercase">UNLOCKED</span></td>
                        </tr>
                        <tr>
                            <td class="py-3 font-mono-tech">OCC-3981</td>
                            <td class="py-3 font-semibold text-slate-800 dark:text-slate-200">Chinedu Okafor</td>
                            <td class="py-3 text-slate-600 dark:text-slate-400">Nelson Mandela Room 8 (Bed 1)</td>
                            <td class="py-3 font-mono-tech text-slate-500">2026-05-04</td>
                            <td class="py-3"><span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-800/50 text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-700/50 rounded font-mono-tech text-[10px] uppercase">LOCKED</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
