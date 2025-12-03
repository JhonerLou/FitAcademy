<x-app-layout>
    <div class="bg-gray-900 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-green-400 font-bold tracking-widest uppercase text-sm mb-2">Knowledge Base</h2>
                <h1 class="text-4xl md:text-5xl font-black text-white">The Science of <span class="text-gray-500">Growth</span></h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($articles as $article)
                <a href="{{ route('member.science.show', $article) }}" class="group relative block bg-gray-800 rounded-2xl overflow-hidden hover:-translate-y-2 transition-all duration-300 border border-gray-700 hover:border-green-500/50">
                    <div class="p-8 h-full flex flex-col">
                        <div class="mb-4">
                            <span class="inline-block px-3 py-1 text-xs font-bold uppercase tracking-wider text-black bg-green-400 rounded-full">
                                {{ str_replace('_', ' ', $article->category) }}
                            </span>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-3 group-hover:text-green-400 transition-colors">
                            {{ $article->title }}
                        </h3>
                        <p class="text-gray-400 text-sm leading-relaxed mb-6 flex-grow">
                            {{ Str::limit($article->summary, 120) }}
                        </p>
                        <div class="flex items-center text-green-400 text-sm font-semibold">
                            Read Article
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
