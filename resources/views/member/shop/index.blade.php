<x-app-layout>
    <div class="bg-gray-900 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

     
            <div class="text-center mb-16">
                <h2 class="text-green-400 font-bold tracking-widest uppercase text-sm mb-2">Store</h2>
                <h1 class="text-4xl md:text-5xl font-black text-white">FitAcademy <span class="text-gray-600">Shop</span></h1>

                @if(session('success'))
                    <div class="mt-6 p-4 bg-green-500/20 border border-green-500 rounded-lg text-green-300 max-w-2xl mx-auto">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('info'))
                    <div class="mt-6 p-4 bg-blue-500/20 border border-blue-500 rounded-lg text-blue-300 max-w-2xl mx-auto">
                        {{ session('info') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="mt-6 p-4 bg-red-500/20 border border-red-500 rounded-lg text-red-300 max-w-2xl mx-auto">
                        {{ session('error') }}
                    </div>
                @endif
            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
                @forelse($products as $product)
                <div class="bg-gray-800 rounded-2xl overflow-hidden border border-gray-700 hover:border-green-500 transition duration-300 flex flex-col group relative">


                    @if($product->stock < 5 && $product->stock > 0)
                        <div class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full z-10 animate-pulse">
                            Only {{ $product->stock }} left!
                        </div>
                    @elseif($product->stock == 0)
                        <div class="absolute top-4 right-4 bg-gray-600 text-white text-xs font-bold px-3 py-1 rounded-full z-10">
                            Sold Out
                        </div>
                    @endif


                    <div class="h-64 overflow-hidden relative">
                        <img src="{{ $product->image_path }}" alt="{{ $product->name }}" class="w-full h-full object-cover opacity-90 group-hover:opacity-100 group-hover:scale-110 transition duration-500 {{ $product->stock == 0 ? 'grayscale' : '' }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent opacity-60"></div>
                    </div>


                    <div class="p-6 flex flex-col flex-grow">
                        <div class="mb-4">
                            <span class="text-xs font-bold text-green-400 uppercase tracking-wider mb-1 block">{{ $product->category }}</span>
                            <h3 class="text-2xl font-bold text-white leading-tight mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-400 text-sm line-clamp-3">{{ $product->description }}</p>
                        </div>

                        <div class="mt-auto pt-6 border-t border-gray-700 flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-500 uppercase">Price</p>
                                <p class="text-xl font-bold text-white font-mono">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                                <p class="text-xs mt-1 font-medium {{ $product->stock > 0 ? 'text-blue-400' : 'text-red-500' }}">
                                    Stock: {{ $product->stock }} available
                                </p>
                            </div>

                            <form action="{{ route('member.shop.purchase', $product) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="px-6 py-3 font-bold rounded-xl transition transform hover:scale-105 shadow-lg {{ $product->stock > 0 ? 'bg-white hover:bg-green-400 text-black' : 'bg-gray-600 text-gray-400 cursor-not-allowed' }}"
                                    {{ $product->stock == 0 ? 'disabled' : '' }}>
                                    {{ $product->stock > 0 ? 'Buy Now' : 'Sold Out' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">Store is currently empty. Check back later!</p>
                </div>
                @endforelse
            </div>

            @if($transactions->count() > 0)
            <div class="max-w-4xl mx-auto">
                <h3 class="text-2xl font-bold text-white mb-6 border-l-4 border-green-500 pl-4">Order History</h3>
                <div class="bg-gray-800 rounded-2xl overflow-hidden border border-gray-700">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-400">
                            <thead class="bg-gray-900/50 text-gray-500 uppercase text-xs">
                                <tr>
                                    <th class="px-6 py-4 font-medium">Date</th>
                                    <th class="px-6 py-4 font-medium">Item</th>
                                    <th class="px-6 py-4 font-medium">Total</th>
                                    <th class="px-6 py-4 font-medium">Status</th>
                                    <th class="px-6 py-4 font-medium">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach($transactions as $trx)
                                <tr class="hover:bg-gray-700/30 transition">
                                    <td class="px-6 py-4">{{ $trx->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $trx->items->first()->product->name ?? 'Product Unavailable' }}
                                        @if($trx->items->count() > 1)
                                            <span class="text-xs text-gray-500 ml-1">(+{{ $trx->items->count() - 1 }} more)</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-mono text-green-400">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded text-xs font-bold uppercase
                                            {{ $trx->status == 'completed' ? 'bg-green-900/30 text-green-400 border border-green-500/30' : '' }}
                                            {{ $trx->status == 'pending' ? 'bg-yellow-900/30 text-yellow-400 border border-yellow-500/30' : '' }}
                                            {{ $trx->status == 'cancelled' ? 'bg-red-900/30 text-red-400 border border-red-500/30' : '' }}">
                                            {{ $trx->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($trx->status == 'pending')
                                            <a href="{{ route('payment.show', $trx) }}" class="text-yellow-400 hover:text-white underline">Pay Now</a>
                                        @else
                                            <span class="text-gray-600">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
