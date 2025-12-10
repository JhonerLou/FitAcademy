<x-app-layout>
    <div class="bg-gray-900 min-h-screen py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <a href="{{ route('member.forum.index') }}" class="text-gray-400 hover:text-white text-sm mb-4 inline-block">&larr; Back to Forum</a>
                <h1 class="text-3xl font-black text-white">Start a Discussion</h1>
            </div>

            <div class="bg-gray-800 rounded-2xl p-8 border border-gray-700">
                <form action="{{ route('member.forum.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-bold text-gray-400 uppercase mb-2">Title</label>
                        <input type="text" name="title" class="w-full bg-gray-900 border border-gray-700 rounded-lg text-white focus:ring-green-500 focus:border-green-500 p-3" placeholder="What's on your mind?" required>
                        @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-400 uppercase mb-2">Category</label>
                        <select name="category" class="w-full bg-gray-900 border border-gray-700 rounded-lg text-white focus:ring-green-500 focus:border-green-500 p-3">
                            <option value="General">General Discussion</option>
                            <option value="Training">Training & Workouts</option>
                            <option value="Nutrition">Nutrition & Diet</option>
                            <option value="Form Check">Form Check (Video/Image)</option>
                            <option value="Off Topic">Off Topic</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-400 uppercase mb-2">Content</label>
                        <textarea name="content" rows="8" class="w-full bg-gray-900 border border-gray-700 rounded-lg text-white focus:ring-green-500 focus:border-green-500 p-3" placeholder="Share your thoughts, questions, or tips..." required></textarea>
                        @error('content') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full py-3 bg-green-500 hover:bg-green-400 text-black font-bold rounded-lg transition">
                        Post Thread
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
