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
                <a href="{{ route('member.science') }}" class="hover:text-green-400 transition">Science</a>
                <a href="{{ route('member.exercises') }}" class="hover:text-green-400 transition">Guide</a>
                <a href="{{ route('member.tools') }}" class="hover:text-green-400 transition">Tools</a>

                <a href="{{ route('member.shop') }}" class="hover:text-green-400 transition">Shop</a>
            </div>

            @if (Route::has('login'))
                <div class="space-x-4">
                    @auth

                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-black font-bold rounded text-sm transition">Join Now</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>


        <div class="relative min-h-screen flex items-center justify-center overflow-hidden -mt-20">

            <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-green-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute bottom-1/4 left-1/4 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>

            <div class="relative max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

                <div class="space-y-6">
                    <p class="text-gray-400 tracking-[0.2em] text-sm font-bold uppercase">Make Your</p>
                    <h1 class="text-7xl md:text-9xl font-black text-white leading-none">
                        BODY <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-600 neon-text">SHAPE</span>
                    </h1>
                    <p class="text-gray-400 text-lg max-w-md leading-relaxed">
                        FitAcademy membantu kamu membangun badan ideal, sehat, dan kuat berdasarkan sains—mulai dari latihan, nutrisi, hingga program latihan rutin.
                    </p>

                    <div class="pt-4 flex space-x-4">
                        <a href="{{ route('member.science') }}" class="inline-flex items-center px-8 py-4 bg-green-500 hover:bg-green-400 text-black font-bold text-lg rounded-full transition transform hover:scale-105 shadow-[0_0_20px_rgba(74,222,128,0.5)]">
                            Get Started
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="{{ route('member.shop') }}" class="inline-flex items-center px-8 py-4 border border-green-500 text-green-400 hover:bg-green-500/10 font-bold text-lg rounded-full transition">
                            Visit Shop
                        </a>
                    </div>
                </div>


                <div class="relative hidden md:block">

                    <img src="https://images.unsplash.com/photo-1583454110551-21f2fa2afe61?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Fitness Model" class="relative z-10 w-full h-auto object-cover rounded-2xl shadow-2xl grayscale hover:grayscale-0 transition duration-700 ease-in-out mask-image-gradient">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent z-20"></div>
                </div>
            </div>
        </div>
    </body>
</html>
