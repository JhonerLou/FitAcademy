<x-app-layout>
    <div class="bg-gray-900 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row justify-between items-end mb-12">
                <div>
                    <h2 class="text-green-400 font-bold tracking-widest uppercase text-sm mb-2">Database</h2>
                    <h1 class="text-4xl font-black text-white">Exercise <span class="text-gray-600">Library</span></h1>
                </div>


                <div class="mt-6 md:mt-0 overflow-x-auto pb-2 md:pb-0 w-full md:w-auto">
                    <div class="flex space-x-2">
                        <a href="{{ route('member.exercises') }}" class="px-4 py-2 rounded-full text-sm font-bold transition {{ !request('muscle') ? 'bg-green-500 text-black' : 'bg-gray-800 text-gray-400 hover:bg-gray-700' }}">
                            All
                        </a>
                        @foreach(['Chest', 'Back', 'Shoulders', 'Legs', 'Arms', 'Abs'] as $muscle)
                            <a href="{{ route('member.exercises', ['muscle' => $muscle]) }}" class="px-4 py-2 rounded-full text-sm font-bold transition whitespace-nowrap {{ request('muscle') == $muscle ? 'bg-green-500 text-black' : 'bg-gray-800 text-gray-400 hover:bg-gray-700' }}">
                                {{ $muscle }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Loop through exercises --}}
                @forelse($exercises as $exercise)
                <div class="bg-gray-800 rounded-xl overflow-hidden border border-gray-700 hover:border-green-500 transition group">

                    <div class="relative h-48 bg-gray-900 overflow-hidden">
                        @if($exercise->image_path)
                            <img src="{{ $exercise->image_path }}" alt="{{ $exercise->name }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-110 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-600">No Image</div>
                        @endif
                        <div class="absolute top-2 right-2 bg-black/70 backdrop-blur px-2 py-1 rounded text-xs font-bold text-white border border-gray-600">
                            {{ $exercise->type }}
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-5">
                        <div class="text-xs font-bold text-green-400 uppercase tracking-wider mb-1">{{ $exercise->muscle_group }}</div>
                        <h3 class="text-lg font-bold text-white mb-2 leading-tight">{{ $exercise->name }}</h3>

                        <p class="text-sm text-gray-400 line-clamp-2" title="{{ $exercise->instructions }}">
                            {{ $exercise->instructions }}
                        </p>

                        @if($exercise->video_url)
                        <a href="{{ $exercise->video_url }}" target="_blank" class="mt-4 block w-full py-2 bg-gray-700 hover:bg-green-500 hover:text-black text-center rounded text-sm font-bold text-white transition">
                            Watch Demo
                        </a>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">No exercises found for this category.</p>
                </div>
                @endforelse
            </div>

   
            <div class="mt-12">
                {{ $exercises->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
