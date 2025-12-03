<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Program') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">

                <form action="{{ route('admin.programs.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Program Name</label>
                            <input type="text" name="name" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-green-500 focus:border-green-500" placeholder="e.g. 12-Week Hypertrophy" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Difficulty</label>
                            <select name="difficulty" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-green-500 focus:border-green-500">
                                <option value="Beginner">Beginner</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Advanced">Advanced</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                        <textarea name="description" rows="3" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-green-500 focus:border-green-500" placeholder="Brief overview of the program goals..." required></textarea>
                    </div>


                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Days Per Week</label>
                        <input type="number" name="days_per_week" class="w-24 bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white focus:ring-green-500 focus:border-green-500" min="1" max="7" required>
                    </div>


                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Routine Details (JSON Format)
                            <span class="text-xs text-gray-500 font-normal ml-2">- Copy the template below and modify it</span>
                        </label>

                        <div class="relative bg-gray-900 rounded-lg border border-gray-700 mb-3 group">
                            <pre class="text-xs text-green-400 p-4 overflow-x-auto font-mono leading-relaxed">
{
  "split_name": "Upper / Lower Split",
  "overview": "4 days per week focusing on compound movements.",
  "weekly_schedule": [
    {
      "day": "Monday",
      "workout_name": "Upper Body Strength",
      "exercises": [
        {
          "name": "Bench Press",
          "sets": 3,
          "reps": "5-8",
          "notes": "Heavy weight, rest 3 mins"
        },
        {
          "name": "Barbell Row",
          "sets": 3,
          "reps": "8-10",
          "notes": "Squeeze at the top"
        }
      ]
    },
    {
      "day": "Tuesday",
      "workout_name": "Lower Body",
      "exercises": []
    },
    {
      "day": "Wednesday",
      "workout_name": "Rest",
      "exercises": []
    }
  ]
}</pre>

                            <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                                <span class="text-xs text-gray-500 bg-black/50 px-2 py-1 rounded">Select & Copy</span>
                            </div>
                        </div>

                        <textarea name="routine_details" rows="20" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white font-mono text-xs focus:ring-green-500 focus:border-green-500 leading-relaxed" placeholder="Paste the JSON structure here..." required></textarea>
                        @error('routine_details') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="px-6 py-2 bg-green-500 hover:bg-green-600 text-black font-bold rounded-lg transition transform hover:scale-105">
                            Create Program
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
