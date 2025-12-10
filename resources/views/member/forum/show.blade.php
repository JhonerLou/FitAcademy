<x-app-layout>
    <div class="bg-gray-900 min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <a href="{{ route('member.forum.index') }}" class="text-gray-400 hover:text-white text-sm mb-6 inline-block">&larr; Back to Forum</a>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/20 border border-green-500 rounded-lg text-green-300">
                    {{ session('success') }}
                </div>
            @endif

 
            <div class="bg-gray-800 rounded-2xl border border-gray-700 overflow-hidden mb-8">
                <div class="p-6 md:p-8">
                    <div class="flex items-center justify-between mb-6">
                        <span class="px-3 py-1 bg-gray-700 text-xs font-bold text-gray-300 rounded-full uppercase tracking-wide">
                            {{ $thread->category }}
                        </span>
                        <span class="text-sm text-gray-500">{{ $thread->created_at->format('M d, Y h:i A') }}</span>
                    </div>

                    <h1 class="text-3xl font-black text-white mb-6">{{ $thread->title }}</h1>

                    <div class="prose prose-invert max-w-none text-gray-300 mb-8">
                        {!! nl2br(e($thread->content)) !!}
                    </div>

                    <div class="flex items-center pt-6 border-t border-gray-700">
                        <div class="h-10 w-10 rounded-full bg-green-500 flex items-center justify-center text-black font-bold mr-3">
                            {{ substr($thread->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-white font-bold text-sm">{{ $thread->user->name }}</p>
                            <p class="text-gray-500 text-xs">Original Poster</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mb-8">
                <h3 class="text-xl font-bold text-white mb-6">{{ $thread->posts->count() }} Replies</h3>

                <div class="space-y-6">
                    @foreach($posts as $post)
                    <div class="bg-gray-800/50 rounded-xl p-6 border border-gray-700/50">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-gray-600 flex items-center justify-center text-white text-xs font-bold mr-3">
                                    {{ substr($post->user->name, 0, 1) }}
                                </div>
                                <span class="text-gray-200 font-bold text-sm">{{ $post->user->name }}</span>
                                @if($post->user_id === $thread->user_id)
                                    <span class="ml-2 px-2 py-0.5 bg-blue-900/50 text-blue-300 text-[10px] font-bold rounded border border-blue-500/30">OP</span>
                                @endif
                                @if($post->user->role === 'admin')
                                    <span class="ml-2 px-2 py-0.5 bg-red-900/50 text-red-300 text-[10px] font-bold rounded border border-red-500/30">ADMIN</span>
                                @endif
                            </div>
                            <span class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="text-gray-300 text-sm leading-relaxed pl-11">
                            {!! nl2br(e($post->content)) !!}
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $posts->links() }}
                </div>
            </div>


            <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                <h3 class="text-lg font-bold text-white mb-4">Leave a Reply</h3>
                <form action="{{ route('member.forum.reply', $thread) }}" method="POST">
                    @csrf
                    <textarea name="content" rows="4" class="w-full bg-gray-900 border border-gray-700 rounded-lg text-white focus:ring-green-500 focus:border-green-500 p-3 mb-4" placeholder="Write your response..." required></textarea>
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-white hover:bg-green-400 text-black font-bold rounded-lg transition">
                            Post Reply
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
