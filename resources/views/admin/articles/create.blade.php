<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Write New Article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">

                <form action="{{ route('admin.articles.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                            <input type="text" name="title" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-green-500 focus:border-green-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>
                            <select name="category" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-green-500 focus:border-green-500">
                                <option value="Training_Science">Training Science</option>
                                <option value="Nutrition">Nutrition</option>
                                <option value="Anatomy">Anatomy</option>
                                <option value="General_Guide">General Guide</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Summary (Short)</label>
                        <textarea name="summary" rows="3" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-green-500 focus:border-green-500"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Content (HTML Supported)</label>
                        <textarea name="content" rows="15" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white font-mono text-sm focus:ring-green-500 focus:border-green-500" placeholder="<h3>Heading</h3><p>Content...</p>"></textarea>
                        <p class="text-xs text-gray-500 mt-2">Use HTML tags for formatting.</p>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_published" id="is_published" class="rounded border-gray-300 text-green-500 shadow-sm focus:ring-green-500" checked>
                        <label for="is_published" class="ml-2 text-sm text-gray-600 dark:text-gray-400">Publish Immediately</label>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="px-6 py-2 bg-green-500 hover:bg-green-600 text-black font-bold rounded-lg transition">
                            Save Article
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
