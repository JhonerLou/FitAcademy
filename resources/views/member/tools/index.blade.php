<x-app-layout>
    <div class="bg-gray-900 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12">
                <h2 class="text-green-400 font-bold tracking-widest uppercase text-sm mb-2">{{ __('Metrics') }}</h2>
                <h1 class="text-4xl font-black text-white">{{ __('Fitness') }} <span
                        class="text-gray-600">{{ __('Tools') }}</span></h1>
            </div>

            @if (session('success'))
                <div
                    class="mb-8 p-4 bg-green-500/20 border border-green-500 rounded-lg text-green-300 text-center max-w-2xl mx-auto">
                    {{ session('success') }}
                </div>
            @endif


            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                <div class="space-y-8">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-1 h-8 bg-blue-500 rounded-full"></div>
                        <h3 class="text-2xl font-bold text-white">{{ __('Body Metrics') }}</h3>
                    </div>

                    <div class="bg-gray-800 rounded-2xl p-8 border border-gray-700">
                        <form action="{{ route('member.tools.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-500 uppercase mb-2">{{ __('Gender') }}</label>
                                    <select name="gender"
                                        class="w-full bg-gray-900 border border-gray-700 rounded-lg text-white">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-500 uppercase mb-2">{{ __('Age') }}</label>
                                    <input type="number" name="age"
                                        class="w-full bg-gray-900 border border-gray-700 rounded-lg text-white"
                                        placeholder="25">
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-500 uppercase mb-2">{{ __('Height (cm)') }}</label>
                                    <input type="number" name="height"
                                        class="w-full bg-gray-900 border border-gray-700 rounded-lg text-white"
                                        placeholder="175">
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-500 uppercase mb-2">{{ __('Weight (kg)') }}</label>
                                    <input type="number" name="weight"
                                        class="w-full bg-gray-900 border border-gray-700 rounded-lg text-white"
                                        placeholder="70">
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-500 uppercase mb-2">{{ __('Activity') }}</label>
                                <select name="activity_level"
                                    class="w-full bg-gray-900 border border-gray-700 rounded-lg text-white">
                                    <option value="sedentary">Sedentary (Office job)</option>
                                    <option value="lightly_active">Lightly Active (1-3 days)</option>
                                    <option value="moderately_active">Moderately Active (3-5 days)</option>
                                    <option value="very_active">Very Active (6-7 days)</option>
                                    <option value="extra_active">Extra Active (Physical job)</option>
                                </select>
                            </div>
                            <button type="submit"
                                class="w-full py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-lg transition">
                                {{ __('Calculate BMI & TDEE') }}
                            </button>
                        </form>
                    </div>

                    @if ($lastResult)
                        <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                            <h4 class="text-sm font-bold text-gray-400 uppercase mb-4">Latest Result</h4>
                            <div class="flex justify-between items-end">
                                <div>
                                    <div class="text-4xl font-black text-white">{{ $lastResult->bmi_result }}</div>
                                    <div class="text-xs text-blue-400 font-bold uppercase mt-1">BMI Score</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-4xl font-black text-white">{{ $lastResult->tdee_result }}</div>
                                    <div class="text-xs text-green-400 font-bold uppercase mt-1">Daily Calories</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="space-y-8">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-1 h-8 bg-green-500 rounded-full"></div>
                        <h3 class="text-2xl font-bold text-white">{{ __('Strength Calculator') }}</h3>
                    </div>


                    <div class="bg-gray-800 rounded-2xl p-8 border border-gray-700 relative overflow-hidden">

                        <div
                            class="absolute -top-10 -right-10 w-40 h-40 bg-green-500/10 rounded-full blur-3xl pointer-events-none">
                        </div>

                        <form action="{{ route('member.tools.strength') }}" method="POST"
                            class="space-y-6 relative z-10">
                            @csrf
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-500 uppercase mb-2">{{ __('Exercise') }}</label>
                                <select name="exercise"
                                    class="w-full bg-gray-900 border border-gray-700 rounded-lg text-white">
                                    <option value="Bench Press">Bench Press</option>
                                    <option value="Squat">Squat</option>
                                    <option value="Deadlift">Deadlift</option>
                                    <option value="Overhead Press">Overhead Press</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-500 uppercase mb-2">{{ __('Weight (kg)') }}</label>
                                    <input type="number" name="weight_lifted" step="0.5"
                                        class="w-full bg-gray-900 border border-gray-700 rounded-lg text-white"
                                        placeholder="100">
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-500 uppercase mb-2">{{ __('Reps') }}</label>
                                    <input type="number" name="reps_performed"
                                        class="w-full bg-gray-900 border border-gray-700 rounded-lg text-white"
                                        placeholder="5">
                                </div>
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-500 uppercase mb-2">{{ __('Your Bodyweight (kg)') }}</label>
                                <input type="number" name="bodyweight"
                                    class="w-full bg-gray-900 border border-gray-700 rounded-lg text-white"
                                    placeholder="75" required>
                                <p class="text-xs text-gray-500 mt-1">Required to calculate your Strength Level.</p>
                            </div>

                            <button type="submit"
                                class="w-full py-3 bg-green-500 hover:bg-green-400 text-black font-bold rounded-lg transition">
                                {{ __('Calculate 1RM') }}
                            </button>
                        </form>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach (['Bench Press', 'Squat', 'Deadlift', 'Overhead Press'] as $lift)
                            @php $record = $latestStrength[$lift]; @endphp
                            <div class="bg-gray-800 p-4 rounded-xl border border-gray-700">
                                <div class="text-xs text-gray-500 uppercase tracking-wider mb-1">{{ $lift }}
                                </div>
                                @if ($record)
                                    <div class="text-2xl font-black text-white">{{ $record->estimated_1rm }} <span
                                            class="text-sm font-normal text-gray-500">kg</span></div>
                                    <div
                                        class="mt-2 inline-block px-2 py-1 rounded text-[10px] font-bold uppercase tracking-widest
                                        {{ $record->strength_level == 'Elite' ? 'bg-purple-900 text-purple-300' : '' }}
                                        {{ $record->strength_level == 'Advanced' ? 'bg-red-900 text-red-300' : '' }}
                                        {{ $record->strength_level == 'Intermediate' ? 'bg-yellow-900 text-yellow-300' : '' }}
                                        {{ $record->strength_level == 'Novice' ? 'bg-blue-900 text-blue-300' : '' }}
                                        {{ $record->strength_level == 'Beginner' ? 'bg-gray-700 text-gray-300' : '' }}">
                                        {{ $record->strength_level }}
                                    </div>
                                @else
                                    <div class="text-sm text-gray-600 italic">No data</div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
