<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Super Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Widgets -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                    <h3 class="text-gray-500 text-sm">Platform Health</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">Optimal</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                    <h3 class="text-gray-500 text-sm">Total ARR</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">₦ 2.4M</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                    <h3 class="text-gray-500 text-sm">Total Companies</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">124</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                    <h3 class="text-gray-500 text-sm">Total Properties</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">5,102</p>
                </div>
            </div>

            <!-- Content Area -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Recent Subscriptions</h3>
                    <p class="text-gray-500 text-sm">Table coming soon...</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
