<x-app-layout>
    <div class="bg-gray-900 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                <div>
                    <h2 class="text-green-400 font-bold tracking-widest uppercase text-sm mb-2">Community</h2>
                    <h1 class="text-4xl font-black text-white">Discussion <span class="text-gray-600">Forum</span></h1>
                </div>
                <a href="{{ route('member.forum.create') }}" class="mt-4 md:mt-0 px-6 py-3 bg-green-500 hover:bg-green-400 text-black font-bold rounded-lg transition transform hover:scale-105 shadow-lg">
                    + Start Discussion
                </a>
            </div>

            <div class="flex flex-col md:flex-row gap-4 mb-8">
                <div class="flex-grow overflow-x-auto pb-2 md:pb-0">
                    <div class="flex space-x-2">
                        <a href="{{ route('member.forum.index') }}" class="px-4 py-2 rounded-full text-sm font-bold transition {{ !request('category') ? 'bg-gray-700 text-white' : 'bg-gray-800 text-gray-400 hover:bg-gray-700' }}">All</a>
                        @foreach(['General', 'Training', 'Nutrition', 'Form Check', 'Off Topic'] as $cat)
                            <a href="{{ route('member.forum.index', ['category' => $cat]) }}" class="px-4 py-2 rounded-full text-sm font-bold transition whitespace-nowrap {{ request('category') == $cat ? 'bg-blue-900 text-blue-200 border border-blue-700' : 'bg-gray-800 text-gray-400 hover:bg-gray-700' }}">
                                {{ $cat }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <form action="{{ route('member.forum.index') }}" method="GET" class="md:w-64">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search topics..." class="w-full bg-gray-800 border border-gray-700 rounded-lg text-white px-4 py-2 focus:ring-green-500 focus:border-green-500 text-sm">
                </form>
            </div>

            <div class="space-y-4">
                @forelse($threads as $thread)
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 hover:border-green-500/50 transition duration-300">
                    <div class="flex items-start justify-between">
                        <div class="flex-grow">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="px-2 py-1 bg-gray-700 text-xs font-bold text-gray-300 rounded uppercase tracking-wider">
                                    {{ $thread->category }}
                                </span>
                                @if($thread->is_pinned)
                                    <span class="px-2 py-1 bg-yellow-900/50 text-yellow-400 border border-yellow-500/50 text-xs font-bold rounded uppercase tracking-wider flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/></svg>
                                        Pinned
                                    </span>
                                @endif
                                <span class="text-xs text-gray-500">{{ $thread->created_at->diffForHumans() }}</span>
                            </div>

                            <a href="{{ route('member.forum.show', $thread) }}" class="text-xl font-bold text-white hover:text-green-400 transition block mb-2">
                                {{ $thread->title }}
                            </a>

                            <div class="flex items-center text-sm text-gray-400">
                                <span class="font-semibold text-gray-300 mr-1">{{ $thread->user->name }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $thread->views }} views</span>
                                <span class="mx-2">•</span>
                                <span>{{ $thread->posts_count }} replies</span>
                            </div>
                        </div>


                        <div class="hidden sm:block flex-shrink-0 ml-4">
                            <div class="h-10 w-10 rounded-full bg-gray-700 flex items-center justify-center text-white font-bold">
                                {{ substr($thread->user->name, 0, 1) }}
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-gray-800 rounded-xl p-12 text-center border border-gray-700">
                    <p class="text-gray-500 text-lg">No discussions found. Be the first to start one!</p>
                </div>
                @endforelse
            </div>


            <div class="mt-8">
                {{ $threads->appends(request()->query())->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
