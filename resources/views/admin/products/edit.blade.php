<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Product') }}: <span class="text-green-400">{{ $product->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8 border border-gray-700">

                <form action="{{ route('admin.products.update', $product) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Product Name</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-green-500 focus:border-green-500 p-2.5" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Category</label>
                            <select name="category" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-green-500 focus:border-green-500 p-2.5">
                                @foreach(['Supplements', 'Equipment', 'Machines', 'Clothing', 'Accessories'] as $cat)
                                    <option value="{{ $cat }}" {{ $product->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Description</label>
                        <textarea name="description" rows="4" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-green-500 focus:border-green-500 p-2.5" required>{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Price (IDR)</label>
                            <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-green-500 focus:border-green-500 p-2.5" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Stock Quantity</label>
                            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-green-500 focus:border-green-500 p-2.5" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Image URL</label>
                            <input type="url" name="image_path" value="{{ old('image_path', $product->image_path) }}" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-green-500 focus:border-green-500 p-2.5">
                        </div>
                    </div>

                    <div class="flex justify-end pt-6 border-t border-gray-700">
                        <a href="{{ route('admin.products') }}" class="px-6 py-2 mr-3 bg-gray-700 hover:bg-gray-600 text-white font-bold rounded-lg transition">Cancel</a>
                        <button type="submit" class="px-6 py-2 bg-green-500 hover:bg-green-600 text-black font-bold rounded-lg transition shadow-lg hover:shadow-green-500/20">
                            Update Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
