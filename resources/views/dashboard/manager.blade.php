<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Property Manager Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Widgets -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border-l-4 border-blue-500">
                    <h3 class="text-gray-500 text-sm">Total Units</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">250</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border-l-4 border-green-500">
                    <h3 class="text-gray-500 text-sm">Occupied Units</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">215</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border-l-4 border-yellow-500">
                    <h3 class="text-gray-500 text-sm">Vacant Units</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">35</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border-l-4 border-red-500">
                    <h3 class="text-gray-500 text-sm">Open Maintenance</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">12</p>
                </div>
            </div>

            <!-- Content Area -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Recent Activities & Move-ins</h3>
                    <p class="text-gray-500 text-sm">Table coming soon...</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
