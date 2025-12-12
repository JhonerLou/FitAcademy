<x-app-layout>
    <div class="bg-gray-900 min-h-screen flex items-center justify-center p-4">

        <div class="bg-gray-800 max-w-md w-full rounded-2xl p-8 text-center border border-green-500/30 shadow-[0_0_50px_rgba(16,185,129,0.1)] relative overflow-hidden">

            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-green-400 to-emerald-600"></div>

            <div class="w-24 h-24 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-[0_0_20px_rgba(34,197,94,0.3)] animate-pulse">
                <svg class="w-12 h-12 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h2 class="text-3xl font-black text-white mb-2 tracking-tight">{{ __('Payment Successful!') }}</h2>
            <p class="text-gray-400 mb-8 text-sm">
                @if($transaction->status == 'completed')
                    {{ __('Your order has been confirmed and processed.') }}
                @else
                    {{ __('We have received your payment. Please wait while we verify the transaction.') }}
                @endif
            </p>

            <div class="bg-gray-900/50 rounded-xl p-6 mb-8 border border-gray-700">
                <div class="flex justify-between items-center mb-3 pb-3 border-b border-gray-700">
                    <span class="text-gray-500 text-xs uppercase tracking-wider">{{ __('Order ID') }}</span>
                    <span class="text-white font-mono font-bold">#{{ $transaction->id }}</span>
                </div>
                <div class="flex justify-between items-center mb-3 pb-3 border-b border-gray-700">
                    <span class="text-gray-500 text-xs uppercase tracking-wider">{{ __('Amount Paid') }}</span>
                    <span class="text-green-400 font-mono font-bold text-lg">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-500 text-xs uppercase tracking-wider">{{ __('Status') }}</span>

                    @if($transaction->status == 'completed')
                        <span class="px-2 py-1 bg-green-900/50 text-green-400 text-xs font-bold rounded uppercase border border-green-500/30">
                            {{ __('Completed') }}
                        </span>
                    @else
                        <span class="px-2 py-1 bg-yellow-900/50 text-yellow-400 text-xs font-bold rounded uppercase border border-yellow-500/30">
                            {{ __('Verifying') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="space-y-3">
                <a href="{{ route('member.shop') }}" class="block w-full py-4 bg-green-500 hover:bg-green-400 text-black font-bold rounded-xl transition transform hover:scale-[1.02] shadow-lg">
                    {{ __('Back to Shop') }}
                </a>
                <a href="{{ route('home') }}" class="block w-full py-4 bg-gray-700 hover:bg-gray-600 text-white font-bold rounded-xl transition">
                    {{ __('Go Home') }}
                </a>
            </div>

        </div>

    </div>
</x-app-layout>
