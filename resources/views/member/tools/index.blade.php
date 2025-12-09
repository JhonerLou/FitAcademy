<x-app-layout>
    <div class="bg-gray-900 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12">
                <h2 class="text-green-400 font-bold tracking-widest uppercase text-sm mb-2">Metrics</h2>
                <h1 class="text-4xl font-black text-white">Body <span class="text-gray-600">Calculator</span></h1>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 bg-gray-800 rounded-2xl p-8 border border-gray-700">
                    <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                        <span class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-black mr-3 text-sm">1</span>
                        Enter Your Stats
                    </h3>

                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-500/20 border border-green-500 rounded-lg text-green-300">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('member.tools.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Gender -->
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">Gender</label>
                                <select name="gender" class="w-full bg-gray-900 border border-gray-700 rounded-lg text-white focus:ring-green-500 focus:border-green-500">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">Age</label>
                                <input type="number" name="age" class="w-full bg-gray-900 border border-gray-700 rounded-lg text-white focus:ring-green-500 focus:border-green-500" placeholder="Years">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">Height (cm)</label>
                                <input type="number" name="height" class="w-full bg-gray-900 border border-gray-700 rounded-lg text-white focus:ring-green-500 focus:border-green-500" placeholder="cm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">Weight (kg)</label>
                                <input type="number" name="weight" class="w-full bg-gray-900 border border-gray-700 rounded-lg text-white focus:ring-green-500 focus:border-green-500" placeholder="kg">
                            </div>
                        </div>


                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Activity Level</label>
                            <select name="activity_level" class="w-full bg-gray-900 border border-gray-700 rounded-lg text-white focus:ring-green-500 focus:border-green-500">
                                <option value="sedentary">Sedentary (Office job, little exercise)</option>
                                <option value="lightly_active">Lightly Active (1-3 days/week)</option>
                                <option value="moderately_active">Moderately Active (3-5 days/week)</option>
                                <option value="very_active">Very Active (6-7 days/week)</option>
                                <option value="extra_active">Extra Active (Physical job + training)</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full py-4 bg-green-500 hover:bg-green-400 text-black font-bold rounded-lg transition transform hover:scale-[1.02]">
                            Calculate Metrics
                        </button>
                    </form>
                </div>

                <div class="space-y-8">

                    <div class="bg-gray-800 rounded-2xl p-8 border border-gray-700 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-green-500/10 rounded-full blur-3xl"></div>

                        <h3 class="text-xl font-bold text-white mb-6">Latest Result</h3>

                        @if($lastResult)
                            <div class="space-y-6">
                                <div>
                                    <p class="text-gray-400 text-xs uppercase tracking-widest">BMI Score</p>
                                    <div class="flex items-baseline">
                                        <span class="text-5xl font-black text-white">{{ $lastResult->bmi_result }}</span>
                                        <span class="ml-2 text-sm font-bold {{ $lastResult->bmi_result < 18.5 ? 'text-yellow-400' : ($lastResult->bmi_result < 25 ? 'text-green-400' : 'text-red-400') }}">
                                            @if($lastResult->bmi_result < 18.5) Underweight
                                            @elseif($lastResult->bmi_result < 25) Normal
                                            @else Overweight
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-gray-400 text-xs uppercase tracking-widest">Daily Calories (TDEE)</p>
                                    <div class="flex items-baseline">
                                        <span class="text-5xl font-black text-green-400">{{ $lastResult->tdee_result }}</span>
                                        <span class="ml-1 text-xl text-gray-500">kcal</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">To maintain current weight</p>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-8 text-gray-500">
                                <p>No data yet. Use the calculator!</p>
                            </div>
                        @endif
                    </div>

                    <div class="bg-gray-800 rounded-2xl p-6 border border-gray-700">
                        <h3 class="text-sm font-bold mb-4 uppercase tracking-widest text-gray-400">Recent History</h3>
                        <div class="space-y-3">
                            @foreach($history->take(3) as $record)
                            <div class="flex justify-between items-center text-sm border-b border-gray-700 pb-2 last:border-0">
                                <span class="text-gray-400">{{ $record->recorded_at->format('M d, Y') }}</span>
                                <span class="text-white font-mono">{{ $record->weight }}kg</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
