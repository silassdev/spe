<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <span class="text-blue-500 font-mono-tech">//</span>
            <h2 class="font-bold text-xl text-slate-900 dark:text-white leading-tight font-mono-tech uppercase">
                Tenant Portal
            </h2>
        </div>
    </x-slot>

    <!-- Tech readouts -->
    <div class="space-y-6">
        
        <!-- Live status telemetry bar -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl relative overflow-hidden group hover:border-blue-500/50 transition">
                <div class="absolute top-1 right-1 text-[9px] font-mono-tech text-slate-400 dark:text-slate-600">TN_01</div>
                <p class="text-xs font-mono-tech text-slate-500 uppercase tracking-wider">Active Lease</p>
                <p class="text-xl font-bold text-slate-900 dark:text-white mt-1">1 Year Apartment Lease</p>
                <div class="mt-2 text-[10px] text-emerald-500 font-mono-tech">Ends 12th August, 2026</div>
            </div>

            <div class="p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl relative overflow-hidden group hover:border-blue-500/50 transition">
                <div class="absolute top-1 right-1 text-[9px] font-mono-tech text-slate-400 dark:text-slate-600">TN_02</div>
                <p class="text-xs font-mono-tech text-slate-500 uppercase tracking-wider">Next Due Date</p>
                <p class="text-2xl font-black text-slate-900 dark:text-white mt-1">12th August, 2026</p>
                <div class="mt-2 text-[10px] text-amber-500 font-mono-tech">₦450,000 Annual Rent</div>
            </div>

            <div class="p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl relative overflow-hidden group hover:border-blue-500/50 transition">
                <div class="absolute top-1 right-1 text-[9px] font-mono-tech text-slate-400 dark:text-slate-600">TN_03</div>
                <p class="text-xs font-mono-tech text-slate-500 uppercase tracking-wider">Maintenance Tickets</p>
                <p class="text-2xl font-black text-slate-900 dark:text-white mt-1">0</p>
                <div class="mt-2 text-[10px] text-emerald-500 font-mono-tech">// ALL_RESOLVED</div>
            </div>
        </div>

        <!-- Middle Columns -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <!-- My Rent Pay card -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-5 relative overflow-hidden">
                <h3 class="font-bold text-slate-900 dark:text-white mb-2 flex items-center gap-2">
                    <span class="text-blue-500 font-mono-tech">//</span> Financial Statement
                </h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-4">View details of your active rental lease and complete outstanding balance payments online.</p>
                
                <div class="space-y-4 mb-6">
                    <div class="flex justify-between border-b border-slate-100 dark:border-slate-800 pb-2 text-xs">
                        <span class="text-slate-500">Invoice Number</span>
                        <span class="font-mono-tech font-bold">INV-2026-0041</span>
                    </div>
                    <div class="flex justify-between border-b border-slate-100 dark:border-slate-800 pb-2 text-xs">
                        <span class="text-slate-500">Rent Amount</span>
                        <span class="font-bold">₦450,000.00</span>
                    </div>
                    <div class="flex justify-between border-b border-slate-100 dark:border-slate-800 pb-2 text-xs">
                        <span class="text-slate-500">Service Charge</span>
                        <span class="font-bold">₦25,000.00</span>
                    </div>
                    <div class="flex justify-between pb-2 text-xs">
                        <span class="text-slate-500 font-bold">Total Amount Due</span>
                        <span class="font-bold text-blue-500">₦475,000.00</span>
                    </div>
                </div>

                <button class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-500 shadow-md shadow-blue-500/20 transition font-mono-tech text-xs uppercase">
                    Pay Rent Now &rarr;
                </button>
            </div>

            <!-- Maintenance Request Logger -->
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-5 relative overflow-hidden">
                <h3 class="font-bold text-slate-900 dark:text-white mb-2 flex items-center gap-2">
                    <span class="text-blue-500 font-mono-tech">//</span> Log Maintenance Ticket
                </h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-4">Need something fixed? Log a ticket below to request repair services from your estate manager.</p>
                
                <form action="#" method="POST" class="space-y-4">
                    <div class="space-y-1">
                        <label class="block text-[10px] font-bold text-slate-500 uppercase">Fault Category</label>
                        <select class="w-full rounded-lg border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 p-2 text-xs">
                            <option>Plumbing (Leaking pipe, blocked sink)</option>
                            <option>Electrical (Blown fuse, wiring issue)</option>
                            <option>Structural (Cracked wall, door repair)</option>
                            <option>Appliances / Generator issues</option>
                        </select>
                    </div>

                    <div class="space-y-1">
                        <label class="block text-[10px] font-bold text-slate-500 uppercase">Description of fault</label>
                        <textarea rows="3" placeholder="Provide full details of the issue..." class="w-full rounded-lg border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 p-2 text-xs"></textarea>
                    </div>

                    <button type="submit" class="w-full border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 font-bold py-2.5 px-4 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800/40 transition font-mono-tech text-xs uppercase">
                        Submit Ticket
                    </button>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
