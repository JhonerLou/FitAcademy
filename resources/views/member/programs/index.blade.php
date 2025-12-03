<x-app-layout>
    <div class="bg-gray-900 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-16">
                <h2 class="text-green-400 font-bold tracking-widest uppercase text-sm mb-2">Structure Your Gains</h2>
                <h1 class="text-4xl md:text-5xl font-black text-white">Training <span class="text-gray-600">Programs</span></h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                @forelse($programs as $program)
                <div class="bg-gray-800 rounded-3xl p-8 border border-gray-700 hover:border-green-500 transition duration-300 flex flex-col h-full relative overflow-hidden group">


                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-gradient-to-br from-green-500/20 to-blue-500/20 rounded-full blur-3xl group-hover:bg-green-500/30 transition"></div>

                    <div class="relative z-10 flex-grow">
                        <div class="flex justify-between items-start mb-6">
                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                                {{ $program->difficulty === 'Beginner' ? 'bg-green-900 text-green-300' : '' }}
                                {{ $program->difficulty === 'Intermediate' ? 'bg-yellow-900 text-yellow-300' : '' }}
                                {{ $program->difficulty === 'Advanced' ? 'bg-red-900 text-red-300' : '' }}">
                                {{ $program->difficulty }}
                            </span>
                            <span class="text-gray-400 font-mono text-sm">
                                {{ $program->days_per_week }} Days / Week
                            </span>
                        </div>

                        <h3 class="text-3xl font-black text-white mb-4">{{ $program->name }}</h3>
                        <p class="text-gray-400 leading-relaxed mb-8">
                            {{ $program->description }}
                        </p>
                    </div>

                    <a href="{{ route('member.programs.show', $program) }}" class="relative z-10 w-full py-4 bg-white hover:bg-green-400 text-black font-bold text-center rounded-xl transition transform group-hover:translate-y-[-2px]">
                        Start Program
                    </a>
                </div>
                @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    No programs available at the moment.
                </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
