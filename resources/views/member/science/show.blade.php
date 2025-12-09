<x-app-layout>
    <div class="bg-gray-900 min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">


            <a href="{{ route('member.science') }}" class="inline-flex items-center text-gray-400 hover:text-white mb-8 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Library
            </a>

            <article class="bg-gray-800 rounded-3xl p-8 md:p-12 border border-gray-700 shadow-2xl">
                <header class="mb-10 border-b border-gray-700 pb-10">
                    <span class="text-green-400 font-bold tracking-widest uppercase text-xs mb-3 block">
                        {{ str_replace('_', ' ', $article->category) }}
                    </span>
                    <h1 class="text-3xl md:text-5xl font-black text-white mb-6 leading-tight">
                        {{ $article->title }}
                    </h1>
                    <p class="text-xl text-white-300 font-light leading-relaxed">
                        {{ $article->summary }}
                    </p>
                </header>


                <div class="prose prose-invert prose-lg max-w-none prose-headings:text-white prose-p:text-white-300 prose-strong:text-green-400 prose-li:text-gray-300">
                    {!! $article->content !!}
                </div>
            </article>

        </div>
    </div>
</x-app-layout>
