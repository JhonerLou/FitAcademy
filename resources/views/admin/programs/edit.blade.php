<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Program') }}: <span class="text-green-400">{{ $program->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">

                <form action="{{ route('admin.programs.update', $program) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Program Name</label>
                            <input type="text" name="name" value="{{ old('name', $program->name) }}" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-green-500 focus:border-green-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Difficulty</label>
                            <select name="difficulty" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-green-500 focus:border-green-500">
                                @foreach(['Beginner', 'Intermediate', 'Advanced'] as $diff)
                                    <option value="{{ $diff }}" {{ $program->difficulty == $diff ? 'selected' : '' }}>{{ $diff }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                        <textarea name="description" rows="3" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-green-500 focus:border-green-500" required>{{ old('description', $program->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Days Per Week</label>
                        <input type="number" name="days_per_week" value="{{ old('days_per_week', $program->days_per_week) }}" class="w-24 bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-green-500 focus:border-green-500" min="1" max="7" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Routine Details (JSON Format)</label>
                        <textarea name="routine_details" rows="20" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white font-mono text-xs focus:ring-green-500 focus:border-green-500" required>{{ old('routine_details', $program->routine_details) }}</textarea>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="px-6 py-2 bg-green-500 hover:bg-green-600 text-black font-bold rounded-lg transition">
                            Update Program
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
