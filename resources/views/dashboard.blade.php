<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-3xl font-black text-white">
                    Welcome back, <span class="text-green-400">{{ Auth::user()->name }}</span>!
                </h1>
                <p class="text-gray-400 mt-2">{{ $tip }}</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-8">


                    <div class="bg-gray-800 rounded-2xl p-8 border border-gray-700 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-48 h-48 bg-green-500/10 rounded-full blur-3xl"></div>

                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-white">Your Metrics</h3>
                            <a href="{{ route('member.tools') }}" class="text-xs text-green-400 font-bold uppercase tracking-wider hover:text-white transition">Update</a>
                        </div>

                        @if($latestMetric)
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                                <div>
                                    <p class="text-gray-500 text-xs uppercase tracking-widest mb-1">Weight</p>
                                    <p class="text-2xl font-bold text-white">{{ $latestMetric->weight }} <span class="text-sm text-gray-500 font-normal">kg</span></p>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-xs uppercase tracking-widest mb-1">Height</p>
                                    <p class="text-2xl font-bold text-white">{{ $latestMetric->height }} <span class="text-sm text-gray-500 font-normal">cm</span></p>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-xs uppercase tracking-widest mb-1">BMI</p>
                                    <p class="text-2xl font-bold {{ $latestMetric->bmi_result < 18.5 || $latestMetric->bmi_result > 25 ? 'text-yellow-400' : 'text-green-400' }}">
                                        {{ $latestMetric->bmi_result }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-xs uppercase tracking-widest mb-1">TDEE</p>
                                    <p class="text-2xl font-bold text-green-400">{{ $latestMetric->tdee_result }} <span class="text-sm text-gray-500 font-normal">kcal</span></p>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-6">
                                <p class="text-gray-400 mb-4">You haven't tracked your stats yet.</p>
                                <a href="{{ route('member.tools') }}" class="inline-block px-6 py-2 bg-green-500 hover:bg-green-400 text-black font-bold rounded-lg transition">Calculate Now</a>
                            </div>
                        @endif
                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <a href="{{ route('member.programs') }}" class="block p-6 bg-gray-800 border border-gray-700 rounded-xl hover:border-green-500 transition group">
                            <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition">
                                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-white mb-1">Workout Programs</h3>
                            <p class="text-sm text-gray-400">Find a routine that fits your goals.</p>
                        </a>


                        <a href="{{ route('member.exercises') }}" class="block p-6 bg-gray-800 border border-gray-700 rounded-xl hover:border-green-500 transition group">
                            <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-white mb-1">Exercise Library</h3>
                            <p class="text-sm text-gray-400">Browse exercises by muscle group.</p>
                        </a>
                    </div>
                </div>

                <div class="space-y-8">


                    <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="font-bold text-white">Nutrition Guide</h3>
                                <p class="text-xs text-gray-400 mt-1">Supplements & Macros</p>
                            </div>
                            <div class="w-10 h-10 bg-yellow-500/20 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                            </div>
                        </div>
                        <a href="{{ route('member.nutrition') }}" class="block w-full py-2 bg-gray-700 hover:bg-gray-600 text-center rounded text-sm font-bold text-white transition">View Guide</a>
                    </div>

                    <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="font-bold text-white">Learn Science</h3>
                                <p class="text-xs text-gray-400 mt-1">Hypertrophy 101</p>
                            </div>
                            <div class="w-10 h-10 bg-green-500/20 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                            </div>
                        </div>
                        <a href="{{ route('member.science') }}" class="block w-full py-2 bg-gray-700 hover:bg-gray-600 text-center rounded text-sm font-bold text-white transition">Read Articles</a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
