<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Accountant Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Widgets -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                    <h3 class="text-gray-500 text-sm">Monthly Revenue</h3>
                    <p class="text-2xl font-bold text-green-600 dark:text-green-400">₦ 12.5M</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                    <h3 class="text-gray-500 text-sm">Overdue Rent</h3>
                    <p class="text-2xl font-bold text-red-600 dark:text-red-400">₦ 1.2M</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                    <h3 class="text-gray-500 text-sm">Pending Invoices</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">45</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                    <h3 class="text-gray-500 text-sm">Recent Payments</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">18</p>
                </div>
            </div>

            <!-- Content Area -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Latest Transactions</h3>
                        <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Generate Report</button>
                    </div>
                    <p class="text-gray-500 text-sm">Transaction list coming soon...</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
