<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Article') }}: <span class="text-green-400">{{ $article->title }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">

                <form action="{{ route('admin.articles.update', $article) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                            <input type="text" name="title" value="{{ old('title', $article->title) }}" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-green-500 focus:border-green-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>
                            <select name="category" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-green-500 focus:border-green-500">
                                @foreach(['Training_Science', 'Nutrition', 'Anatomy', 'General_Guide'] as $cat)
                                    <option value="{{ $cat }}" {{ $article->category == $cat ? 'selected' : '' }}>{{ str_replace('_', ' ', $cat) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Summary</label>
                        <textarea name="summary" rows="3" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-green-500 focus:border-green-500">{{ old('summary', $article->summary) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Content</label>
                        <textarea name="content" rows="15" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white font-mono text-sm focus:ring-green-500 focus:border-green-500">{{ old('content', $article->content) }}</textarea>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_published" id="is_published" class="rounded border-gray-300 text-green-500 shadow-sm focus:ring-green-500" {{ $article->is_published ? 'checked' : '' }}>
                        <label for="is_published" class="ml-2 text-sm text-gray-600 dark:text-gray-400">Published</label>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="px-6 py-2 bg-green-500 hover:bg-green-600 text-black font-bold rounded-lg transition">
                            Update Article
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
