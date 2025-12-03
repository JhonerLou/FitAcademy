<x-app-layout>
    <div class="bg-gray-900 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-16">
                <h2 class="text-green-400 font-bold tracking-widest uppercase text-sm mb-2">Fuel Your Body</h2>
                <h1 class="text-4xl md:text-5xl font-black text-white">Nutrition & <span class="text-gray-600">Supplements</span></h1>
            </div>

            <!-- Section 1: Supplements -->
            <div class="mb-30">
                <div class="flex items-center mb-8">
                    <div class="w-1 h-8 bg-green-500 mr-4 rounded-full"></div>
                    <h3 class="text-2xl font-bold text-white">Proven Supplements</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
                    @forelse($supplements as $item)
                    <div class="bg-gray-800 rounded-2xl p-8 border border-gray-700 hover:border-green-500/50 transition duration-300 relative overflow-hidden group">
                        <!-- Decorative bg -->
                        <div class="absolute top-0 right-0 w-32 h-32 bg-green-500/5 rounded-full blur-3xl group-hover:bg-green-500/10 transition"></div>

                        <div class="relative z-10">
                            <div class="flex justify-between items-start mb-4">
                                <h4 class="text-xl font-bold text-white">{{ $item->name }}</h4>
                                <span class="px-3 py-1 bg-gray-700 text-xs font-bold text-gray-300 rounded-full uppercase tracking-wide">
                                    {{ $item->category }}
                                </span>
                            </div>

                            <p class="text-gray-400 mb-6 leading-relaxed text-sm h-16 overflow-hidden">
                                {{ $item->description }}
                            </p>

                            <div class="flex items-center justify-between border-t border-gray-700 pt-4 mt-auto">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Dosage</p>
                                    <p class="text-green-400 font-mono text-sm font-bold">{{ $item->dosage }}</p>
                                </div>
                                @if($item->calories_per_serving > 0)
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1 text-right">Calories</p>
                                    <p class="text-white font-mono text-sm font-bold text-right">{{ $item->calories_per_serving }} kcal</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 col-span-full">No supplements found.</p>
                    @endforelse
                </div>
            </div>

            <!-- Section 2: Food Sources -->
            <div>
                <div class="flex items-center mb-8 mt-20">
                    <div class="w-1 h-8 bg-blue-500 mr-4 rounded-full"></div>
                    <h3 class="text-2xl font-bold text-white">Quality Food Sources</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse($foods as $food)
                    <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 hover:bg-gray-750 transition">
                        <h4 class="text-lg font-bold text-white mb-2">{{ $food->name }}</h4>
                        <p class="text-gray-400 text-xs mb-4 min-h-[3rem]">{{ $food->description }}</p>

                        <div class="flex items-center space-x-4 text-xs font-mono">
                            <span class="bg-blue-900/30 text-blue-300 px-2 py-1 rounded">
                                {{ $food->dosage }}
                            </span>
                            <span class="text-gray-500">
                                ~{{ $food->calories_per_serving }} kcal
                            </span>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 col-span-full">No food sources found.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
