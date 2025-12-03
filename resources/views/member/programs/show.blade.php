<x-app-layout>
    <div class="bg-gray-900 min-h-screen py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-12">
                <a href="{{ route('member.programs') }}" class="inline-flex items-center text-gray-400 hover:text-white mb-6 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Programs
                </a>
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <h1 class="text-4xl font-black text-white">{{ $program->name }}</h1>
                    <span class="px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-sm font-mono text-green-400">
                        {{ $program->days_per_week }} Days / Week
                    </span>
                </div>
                <p class="text-gray-400 mt-4 text-lg max-w-3xl">{{ $program->description }}</p>
            </div>


            <div class="space-y-8">
                @if(isset($routine['weekly_schedule']) && is_array($routine['weekly_schedule']))

                    @foreach($routine['weekly_schedule'] as $day)
                        <div class="bg-gray-800 rounded-2xl border border-gray-700 overflow-hidden">

                            <div class="px-6 py-4 bg-gray-900/50 border-b border-gray-700 flex justify-between items-center">
                                <h3 class="text-xl font-bold text-white">{{ $day['day'] }}</h3>
                                <span class="text-sm font-medium {{ $day['workout_name'] == 'Rest' ? 'text-gray-500' : 'text-green-400' }}">
                                    {{ $day['workout_name'] }}
                                </span>
                            </div>

                            
                            @if(!empty($day['exercises']))
                                <div class="overflow-x-auto">
                                    <table class="w-full text-left text-sm text-gray-400">
                                        <thead class="text-xs uppercase bg-gray-900/30 text-gray-500">
                                            <tr>
                                                <th class="px-6 py-3 font-medium">Exercise</th>
                                                <th class="px-6 py-3 font-medium">Sets</th>
                                                <th class="px-6 py-3 font-medium">Reps</th>
                                                <th class="px-6 py-3 font-medium">Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-700">
                                            @foreach($day['exercises'] as $exercise)
                                                <tr class="hover:bg-gray-700/30 transition">
                                                    <td class="px-6 py-4 font-bold text-white">{{ $exercise['name'] }}</td>
                                                    <td class="px-6 py-4 font-mono">{{ $exercise['sets'] }}</td>
                                                    <td class="px-6 py-4 font-mono">{{ $exercise['reps'] }}</td>
                                                    <td class="px-6 py-4 text-xs italic text-gray-500">{{ $exercise['notes'] ?? '-' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="p-6 text-center text-gray-600 italic">
                                    Rest and Recover.
                                </div>
                            @endif
                        </div>
                    @endforeach

                @else
                    <div class="p-12 bg-gray-800 rounded-2xl text-center">
                        <p class="text-red-400">Error: Routine details format is invalid.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
