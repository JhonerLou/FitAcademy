<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Order #{{ $transaction->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/20 border border-green-500 rounded-lg text-green-300">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">

                <!-- Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8 border-b border-gray-200 dark:border-gray-700 pb-8">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4">Customer Info</h3>
                        <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $transaction->user->name }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $transaction->user->email }}</p>
                        <p class="text-xs text-gray-400 mt-2">Ordered on {{ $transaction->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    <div class="text-left md:text-right">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4">Order Status</h3>
                        <span class="px-4 py-2 rounded-lg text-sm font-bold uppercase
                            {{ $transaction->status == 'completed' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $transaction->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $transaction->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ $transaction->status }}
                        </span>

                        <!-- Manual Status Update Form -->
                        <form action="{{ route('admin.transactions.update', $transaction) }}" method="POST" class="mt-6 flex justify-end items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block p-2.5 text-gray-900 dark:text-white">
                                <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ $transaction->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $transaction->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-bold transition">
                                Update
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Items -->
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4">Order Items</h3>
                <div class="bg-gray-50 dark:bg-gray-900 rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Product</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Price</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Qty</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-sm text-gray-700 dark:text-gray-300">
                            @foreach($transaction->items as $item)
                            <tr>
                                <td class="px-6 py-4 font-bold">{{ $item->product->name ?? 'Deleted Product' }}</td>
                                <td class="px-6 py-4 text-right font-mono">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-right">{{ $item->quantity }}</td>
                                <td class="px-6 py-4 text-right font-mono font-bold">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                            <!-- Total Row -->
                            <tr class="bg-gray-100 dark:bg-gray-800 font-bold">
                                <td colspan="3" class="px-6 py-4 text-right uppercase">Grand Total</td>
                                <td class="px-6 py-4 text-right font-mono text-lg text-green-500">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 flex justify-between items-center">
                    <a href="{{ route('admin.transactions') }}" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 underline text-sm">
                        &larr; Back to Orders
                    </a>

                    @if($transaction->note)
                    <div class="text-xs text-gray-400">
                        Invoice Ref: <span class="font-mono">{{ $transaction->note }}</span>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
