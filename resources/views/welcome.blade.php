<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FitAcademy</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
        <style>
            body { font-family: 'Inter', sans-serif; }
            .neon-text { text-shadow: 0 0 10px rgba(74, 222, 128, 0.5); }
        </style>
    </head>
    <body class="bg-black text-white antialiased">

        <div class="relative w-full max-w-7xl mx-auto px-6 py-6 flex justify-between items-center z-10">
            <div class="text-2xl font-black tracking-tighter text-green-400">FIT<span class="text-white">ACADEMY</span></div>

            <div class="space-x-8 hidden md:flex text-sm font-semibold uppercase tracking-widest text-gray-400">
                <a href="{{ route('member.science') }}" class="hover:text-green-400 transition">{{ __('Science') }}</a>
                <a href="{{ route('member.exercises') }}" class="hover:text-green-400 transition">{{ __('Guide') }}</a>
                <a href="{{ route('member.tools') }}" class="hover:text-green-400 transition">{{ __('Tools') }}</a>
                <a href="{{ route('member.shop') }}" class="hover:text-green-400 transition">{{ __('Shop') }}</a>
            </div>

            <div class="flex items-center space-x-4">

                <div class="hidden md:flex items-center space-x-2 text-xs font-bold mr-4">
                    <a href="{{ route('lang.switch', 'en') }}" class="{{ App::getLocale() == 'en' ? 'text-green-400' : 'text-gray-600 hover:text-white' }}">EN</a>
                    <span class="text-gray-700">|</span>
                    <a href="{{ route('lang.switch', 'id') }}" class="{{ App::getLocale() == 'id' ? 'text-green-400' : 'text-gray-600 hover:text-white' }}">ID</a>
                </div>

                @if (Route::has('login'))
                    <div class="space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-300 hover:text-white">{{ __('Dashboard') }}</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white">{{ __('Log in') }}</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-black font-bold rounded text-sm transition">{{ __('Join Now') }}</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>

        <div class="relative min-h-[90vh] flex items-center justify-center overflow-hidden -mt-20">
            <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-green-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute bottom-1/4 left-1/4 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>

            <div class="relative max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

                <div class="space-y-6">
                    <p class="text-gray-400 tracking-[0.2em] text-sm font-bold uppercase">{{ __('Make Your') }}</p>
                    <h1 class="text-7xl md:text-9xl font-black text-white leading-none">
                        {{ __('BODY') }} <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-600 neon-text">{{ __('SHAPE') }}</span>
                    </h1>

                    <p class="text-gray-400 text-lg max-w-md leading-relaxed">
                        {{ __('FitAcademy helps you build your ideal, healthy, and strong body based on science—from training and nutrition to routine workout programs.') }}
                    </p>

                    <div class="pt-4 flex space-x-4">
                        <a href="{{ route('member.science') }}" class="inline-flex items-center px-8 py-4 bg-green-500 hover:bg-green-400 text-black font-bold text-lg rounded-full transition transform hover:scale-105 shadow-[0_0_20px_rgba(74,222,128,0.5)]">
                            {{ __('Get Started') }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="{{ route('member.shop') }}" class="inline-flex items-center px-8 py-4 border border-green-500 text-green-400 hover:bg-green-500/10 font-bold text-lg rounded-full transition">
                            {{ __('Visit Shop') }}
                        </a>
                    </div>
                </div>

                <div class="relative hidden md:block">
                    <img src="https://images.unsplash.com/photo-1583454110551-21f2fa2afe61?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Fitness Model" class="relative z-10 w-full h-auto object-cover rounded-2xl shadow-2xl grayscale hover:grayscale-0 transition duration-700 ease-in-out mask-image-gradient">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent z-20"></div>
                </div>
            </div>
        </div>

 
        @if(isset($products) && $products->count() > 0)
        <div class="bg-gray-900 py-24 relative overflow-hidden border-t border-gray-800">
            <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-green-500/50 to-transparent"></div>

            <div class="max-w-7xl mx-auto px-6 relative z-10">
                <div class="text-center mb-16">
                    <h2 class="text-green-400 font-bold tracking-widest uppercase text-sm mb-2">{{ __('Shop') }}</h2>
                    <h2 class="text-4xl font-black text-white">{{ __('Premium') }} <span class="text-gray-600">{{ __('Courses & Gear') }}</span></h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($products as $product)
                    <div class="group bg-gray-800 rounded-2xl overflow-hidden border border-gray-700 hover:border-green-500 transition duration-300 flex flex-col h-full">
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ $product->image_path }}" alt="{{ $product->name }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                            <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition"></div>

                            <!-- Price Tag -->
                            <div class="absolute bottom-4 right-4 bg-green-500 text-black font-bold px-3 py-1 rounded-full text-sm shadow-lg">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-grow">
                            <div class="text-xs font-bold text-green-400 uppercase tracking-wider mb-2">{{ $product->category }}</div>
                            <h3 class="text-lg font-bold text-white mb-2 leading-tight">{{ $product->name }}</h3>
                            <p class="text-gray-400 text-sm mb-4 flex-grow whitespace-normal break-words">{{ $product->description }}</p>

                            <form action="{{ route('member.shop.purchase', $product) }}" method="POST" class="mt-auto">
                                @csrf
                                <button type="submit" class="w-full py-3 bg-gray-700 hover:bg-green-500 hover:text-black text-white font-bold rounded-lg transition flex justify-center items-center group-hover:shadow-green-500/20 group-hover:shadow-lg">
                                    {{ __('Buy Now') }}
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-16 text-center">
                    <a href="{{ route('member.shop') }}" class="inline-flex items-center text-lg font-bold text-white hover:text-green-400 transition duration-300">
                        {{ __('View All Products') }}
                        <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
        @endif

    </body>
</html>
