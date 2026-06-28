<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>User Onboarding | Hausify</title>

    <!-- Fonts: Outfit and JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700;800&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Inline script to prevent theme flickering -->
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
        .font-mono-tech {
            font-family: 'JetBrains Mono', monospace;
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased transition-colors duration-300 min-h-screen flex flex-col relative">

    <!-- Reusable Connected Tiny Squares Mesh Background -->
    <x-tech-squares />

    <div class="min-h-screen flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8 relative z-10"
         x-data="{
            step: 1,
            role: '',
            country: 'Nigeria',
            state: '',
            lga: '',
            town: '',
            street: '',
            next_of_kin: '',
            gender: '',
            dob: '',
            validateStep1() {
                if(!this.role) {
                    alert('Please select your user account type to proceed.');
                    return false;
                }
                this.step = 2;
                return true;
            }
         }"
    >
        <!-- Onboarding Wizard Card -->
        <div class="w-full max-w-2xl bg-white/95 dark:bg-slate-900/90 backdrop-blur border border-slate-200 dark:border-slate-800/80 shadow-2xl rounded-2xl p-6 sm:p-8 relative overflow-hidden transition-all duration-300">
            <!-- Grid decor plus markers -->
            <div class="absolute top-1.5 left-1.5 text-slate-300 dark:text-slate-700 font-mono text-[9px] select-none pointer-events-none">+</div>
            <div class="absolute bottom-1.5 right-1.5 text-slate-300 dark:text-slate-700 font-mono text-[9px] select-none pointer-events-none">+</div>

            <!-- Top Header -->
            <div class="border-b border-slate-200 dark:border-slate-800 pb-4 mb-6 flex justify-between items-center">
                <div>
                    <h1 class="text-xl font-extrabold text-slate-900 dark:text-white">Workspace Configuration</h1>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Complete your registration to deploy your dashboard.</p>
                </div>
                <div class="font-mono-tech text-xs text-slate-400 dark:text-slate-500 bg-slate-100 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 px-2 py-1 rounded">
                    STEP <span x-text="step">1</span> / 2
                </div>
            </div>

            <!-- Main Form -->
            <form action="{{ route('onboarding') }}" method="POST" class="space-y-6">
                @csrf

                <!-- STEP 1: USER ROLE SELECTION -->
                <div x-show="step === 1" class="space-y-6 animate-[fadeIn_0.3s_ease-out]">
                    <div class="space-y-1">
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">// 01. SELECT YOUR USER TYPE</label>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Choose the profile that matches your property platform needs. Admin sign-ups are restricted.</p>
                    </div>

                    <!-- Role Options Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Option 1: Landlord -->
                        <div 
                            @click="role = 'landlord'"
                            :class="role === 'landlord' ? 'border-emerald-500 bg-emerald-500/5 dark:bg-emerald-500/10 ring-2 ring-emerald-500/30' : 'border-slate-200 dark:border-slate-800 hover:border-slate-300 dark:hover:border-slate-700 bg-white/50 dark:bg-slate-900/50'"
                            class="rounded-xl border p-4 cursor-pointer transition-all duration-200 flex flex-col justify-between h-32 relative group"
                        >
                            <div>
                                <span class="font-mono-tech text-[9px] text-emerald-500 uppercase">// PROP_OWNER</span>
                                <h3 class="font-bold text-slate-900 dark:text-white mt-1">Landlord / Manager</h3>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1">Manage estates, buildings, rent collections, and logs.</p>
                            </div>
                            <div class="text-right">
                                <span x-show="role === 'landlord'" class="text-emerald-500 font-bold font-mono-tech text-xs">[ SELECTED ]</span>
                            </div>
                        </div>

                        <!-- Option 2: Tenant -->
                        <div 
                            @click="role = 'tenant'"
                            :class="role === 'tenant' ? 'border-blue-500 bg-blue-500/5 dark:bg-blue-500/10 ring-2 ring-blue-500/30' : 'border-slate-200 dark:border-slate-800 hover:border-slate-300 dark:hover:border-slate-700 bg-white/50 dark:bg-slate-900/50'"
                            class="rounded-xl border p-4 cursor-pointer transition-all duration-200 flex flex-col justify-between h-32 relative group"
                        >
                            <div>
                                <span class="font-mono-tech text-[9px] text-blue-500 uppercase">// ACQUIRE_LEASE</span>
                                <h3 class="font-bold text-slate-900 dark:text-white mt-1">Tenant / Resident</h3>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1">View active rents, settle payments, and log repairs.</p>
                            </div>
                            <div class="text-right">
                                <span x-show="role === 'tenant'" class="text-blue-500 font-bold font-mono-tech text-xs">[ SELECTED ]</span>
                            </div>
                        </div>

                        <!-- Option 3: School Admin -->
                        <div 
                            @click="role = 'school_admin'"
                            :class="role === 'school_admin' ? 'border-purple-500 bg-purple-500/5 dark:bg-purple-500/10 ring-2 ring-purple-500/30' : 'border-slate-200 dark:border-slate-800 hover:border-slate-300 dark:hover:border-slate-700 bg-white/50 dark:bg-slate-900/50'"
                            class="rounded-xl border p-4 cursor-pointer transition-all duration-200 flex flex-col justify-between h-32 relative group"
                        >
                            <div>
                                <span class="font-mono-tech text-[9px] text-purple-500 uppercase">// SCH_OFFICER</span>
                                <h3 class="font-bold text-slate-900 dark:text-white mt-1">School Administrator</h3>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1">Manage academic boarding blocks and dorm fees.</p>
                            </div>
                            <div class="text-right">
                                <span x-show="role === 'school_admin'" class="text-purple-500 font-bold font-mono-tech text-xs">[ SELECTED ]</span>
                            </div>
                        </div>

                        <!-- Option 4: Hostel Warden -->
                        <div 
                            @click="role = 'hostel_warden'"
                            :class="role === 'hostel_warden' ? 'border-amber-500 bg-amber-500/5 dark:bg-amber-500/10 ring-2 ring-amber-500/30' : 'border-slate-200 dark:border-slate-800 hover:border-slate-300 dark:hover:border-slate-700 bg-white/50 dark:bg-slate-900/50'"
                            class="rounded-xl border p-4 cursor-pointer transition-all duration-200 flex flex-col justify-between h-32 relative group"
                        >
                            <div>
                                <span class="font-mono-tech text-[9px] text-amber-500 uppercase">// HOSTEL_REP</span>
                                <h3 class="font-bold text-slate-900 dark:text-white mt-1">Hostel Warden</h3>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1">Audit bed spaces, room logs, and tenant status.</p>
                            </div>
                            <div class="text-right">
                                <span x-show="role === 'hostel_warden'" class="text-amber-500 font-bold font-mono-tech text-xs">[ SELECTED ]</span>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden input to submit the role -->
                    <input type="hidden" name="role" x-model="role">

                    <!-- Button to Next step -->
                    <div class="pt-4 border-t border-slate-200 dark:border-slate-800 flex justify-end">
                        <button 
                            type="button" 
                            @click="validateStep1()"
                            class="bg-emerald-500 text-white rounded-lg px-6 py-3 font-semibold hover:bg-emerald-400 transition font-mono-tech text-xs uppercase"
                        >
                            CONTINUE_TO_PROFILE &rarr;
                        </button>
                    </div>
                </div>

                <!-- STEP 2: PROFILE DETAILS FORM -->
                <div x-show="step === 2" class="space-y-5 animate-[fadeIn_0.3s_ease-out]" style="display: none;">
                    <div class="space-y-1">
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">// 02. PROFILE & LOCATION DETAILS</label>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Provide your detailed demographic and address records to activate your node.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Country -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-600 dark:text-slate-400">Country</label>
                            <input 
                                type="text" 
                                name="country" 
                                x-model="country" 
                                placeholder="e.g. Nigeria" 
                                required
                                class="w-full rounded-lg border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-950 p-2.5 text-sm focus:border-emerald-500 focus:ring-emerald-500/20"
                            >
                        </div>

                        <!-- State -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-600 dark:text-slate-400">State</label>
                            <input 
                                type="text" 
                                name="state" 
                                x-model="state" 
                                placeholder="e.g. Lagos" 
                                required
                                class="w-full rounded-lg border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-950 p-2.5 text-sm focus:border-emerald-500 focus:ring-emerald-500/20"
                            >
                        </div>

                        <!-- Local Government Area -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-600 dark:text-slate-400">Local Government Area (LGA)</label>
                            <input 
                                type="text" 
                                name="lga" 
                                x-model="lga" 
                                placeholder="e.g. Ikeja" 
                                required
                                class="w-full rounded-lg border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-950 p-2.5 text-sm focus:border-emerald-500 focus:ring-emerald-500/20"
                            >
                        </div>

                        <!-- Town -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-600 dark:text-slate-400">Town / District Name</label>
                            <input 
                                type="text" 
                                name="town" 
                                x-model="town" 
                                placeholder="e.g. Allen Avenue" 
                                required
                                class="w-full rounded-lg border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-950 p-2.5 text-sm focus:border-emerald-500 focus:ring-emerald-500/20"
                            >
                        </div>

                        <!-- Street Name & Number -->
                        <div class="space-y-1.5 sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-600 dark:text-slate-400">Street Address (Name & Number)</label>
                            <input 
                                type="text" 
                                name="street" 
                                x-model="street" 
                                placeholder="e.g. 14, Olowu Street" 
                                required
                                class="w-full rounded-lg border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-950 p-2.5 text-sm focus:border-emerald-500 focus:ring-emerald-500/20"
                            >
                        </div>

                        <!-- Next of Kin -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-600 dark:text-slate-400">Next of Kin (Full Name & Contact)</label>
                            <input 
                                type="text" 
                                name="next_of_kin" 
                                x-model="next_of_kin" 
                                placeholder="e.g. Samuel Obi (08012345678)" 
                                required
                                class="w-full rounded-lg border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-950 p-2.5 text-sm focus:border-emerald-500 focus:ring-emerald-500/20"
                            >
                        </div>

                        <!-- Sex (Gender) -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-slate-600 dark:text-slate-400">Sex (M or F)</label>
                            <select 
                                name="gender" 
                                x-model="gender" 
                                required
                                class="w-full rounded-lg border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-950 p-2.5 text-sm focus:border-emerald-500 focus:ring-emerald-500/20"
                            >
                                <option value="">Select Gender</option>
                                <option value="M">Male (M)</option>
                                <option value="F">Female (F)</option>
                            </select>
                        </div>

                        <!-- Date of Birth -->
                        <div class="space-y-1.5 sm:col-span-2">
                            <label class="block text-xs font-bold text-slate-600 dark:text-slate-400">Date of Birth</label>
                            <input 
                                type="date" 
                                name="dob" 
                                x-model="dob" 
                                required
                                class="w-full rounded-lg border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-950 p-2.5 text-sm focus:border-emerald-500 focus:ring-emerald-500/20"
                            >
                        </div>
                    </div>

                    <!-- Step 2 Navigation Actions -->
                    <div class="pt-4 border-t border-slate-200 dark:border-slate-800 flex justify-between">
                        <button 
                            type="button" 
                            @click="step = 1"
                            class="border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 rounded-lg px-6 py-3 font-semibold hover:bg-slate-50 dark:hover:bg-slate-800 transition font-mono-tech text-xs uppercase"
                        >
                            &larr; BACK
                        </button>
                        
                        <button 
                            type="submit"
                            class="bg-emerald-500 text-white rounded-lg px-8 py-3 font-bold hover:bg-emerald-400 shadow-lg shadow-emerald-500/20 transition font-mono-tech text-xs uppercase"
                        >
                            ACTIVATE_DASHBOARD &rarr;
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
