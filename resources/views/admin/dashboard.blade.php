<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase">{{ __('Total Orders') }}
                    </div>
                    <div class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['orders'] }}</div>
                </div>


                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase">{{ __('Total Users') }}
                    </div>
                    <div class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['users'] }}</div>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-purple-500">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase">{{ __('Products') }}
                    </div>
                    <div class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['products'] }}</div>
                </div>
            </div>


            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('Manage Content') }}
                        </h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
                            <a href="{{ route('admin.users') }}"
                                class="flex flex-col items-center justify-center p-4 bg-orange-50 dark:bg-orange-900/30 rounded-lg hover:bg-orange-100 dark:hover:bg-orange-800 transition group border border-orange-200 dark:border-orange-700">
                                <span class="text-2xl mb-2 group-hover:scale-110 transition">👥</span>
                                <span
                                    class="text-xs font-bold text-orange-800 dark:text-orange-300">{{ __('Users') }}</span>
                            </a>
                            <a href="{{ route('admin.transactions') }}"
                                class="flex flex-col items-center justify-center p-4 bg-blue-50 dark:bg-blue-900/30 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-800 transition group border border-blue-200 dark:border-blue-700">
                                <span class="text-2xl mb-2 group-hover:scale-110 transition">🛒</span>
                                <span
                                    class="text-xs font-bold text-blue-800 dark:text-blue-300">{{ __('Orders') }}</span>
                            </a>
                            <a href="{{ route('admin.products') }}"
                                class="flex flex-col items-center justify-center p-4 bg-purple-50 dark:bg-purple-900/30 rounded-lg hover:bg-purple-100 dark:hover:bg-purple-800 transition group border border-purple-200 dark:border-purple-700">
                                <span class="text-2xl mb-2 group-hover:scale-110 transition">📦</span>
                                <span
                                    class="text-xs font-bold text-purple-800 dark:text-purple-300">{{ __('Products') }}</span>
                            </a>

                            <a href="{{ route('admin.exercises') }}"
                                class="flex flex-col items-center justify-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition group">
                                <span class="text-2xl mb-2">💪</span>
                                <span
                                    class="text-xs font-medium text-gray-700 dark:text-gray-300">{{ __('Exercises') }}</span>
                            </a>
                            <a href="{{ route('admin.programs') }}"
                                class="flex flex-col items-center justify-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition group">
                                <span class="text-2xl mb-2">📅</span>
                                <span
                                    class="text-xs font-medium text-gray-700 dark:text-gray-300">{{ __('Programs') }}</span>
                            </a>
                            <a href="{{ route('admin.articles') }}"
                                class="flex flex-col items-center justify-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition group">
                                <span class="text-2xl mb-2">🔬</span>
                                <span
                                    class="text-xs font-medium text-gray-700 dark:text-gray-300">{{ __('Science') }}</span>
                            </a>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('Recent Orders') }}
                            </h3>
                            <a href="{{ route('admin.transactions') }}"
                                class="text-sm text-green-400 hover:text-white">{{ __('View All') }}</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">
                                            {{ __('ID') }}</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">
                                            {{ __('User') }}</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">
                                            {{ __('Total') }}</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">
                                            {{ __('Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($recentOrders as $order)
                                        <tr>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-500 dark:text-gray-400">
                                                #{{ $order->id }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white font-bold">
                                                {{ $order->user->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-400 font-mono">Rp
                                                {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 h-fit">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('New Members') }}</h3>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($recentUsers as $user)
                            <li class="py-4 flex items-center">
                                <div
                                    class="h-10 w-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500 dark:text-gray-300 font-bold">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
