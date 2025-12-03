<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Program::create([
            'name' => 'Beginner Bodybuilding Foundation',
            'description' => 'A 5-day split designed to build a solid base of strength and hypertrophy. Focuses on mastering technique with "Foundation Sets" before increasing volume. Uses an Upper/Lower + PPL Hybrid split.',
            'difficulty' => 'Beginner',
            'days_per_week' => 5,
            'routine_details' => json_encode([
                'split_name' => 'Upper / Lower / Pull / Push / Legs',
                'overview' => 'Frequency: 5 days/week. Focus: Linear progression and technique mastery.',
                'weekly_schedule' => [
                    [
                        'day' => 'Monday',
                        'workout_name' => 'Upper Body (Strength Focus)',
                        'exercises' => [
                            ['name' => '45° Incline Dumbbell Press', 'sets' => 3, 'reps' => '8-10', 'notes' => 'Focus on upper chest stretch.'],
                            ['name' => 'Chest Supported Machine Row', 'sets' => 3, 'reps' => '10-12', 'notes' => 'Squeeze shoulder blades at the top.'],
                            ['name' => 'Machine Shoulder Press', 'sets' => 3, 'reps' => '10-12', 'notes' => 'Keep core tight, do not arch back excessively.'],
                            ['name' => 'Neutral Grip Lat Pulldown', 'sets' => 3, 'reps' => '10-12', 'notes' => 'Drive elbows down to hips.'],
                            ['name' => 'Overhead Cable Tricep Extension', 'sets' => 2, 'reps' => '12-15', 'notes' => 'Focus on the stretch behind the head.'],
                        ]
                    ],
                    [
                        'day' => 'Tuesday',
                        'workout_name' => 'Lower Body (Strength Focus)',
                        'exercises' => [
                            ['name' => 'Smith Machine Squat', 'sets' => 3, 'reps' => '6-8', 'notes' => 'Control the negative (3 seconds down).'],
                            ['name' => 'Romanian Deadlift (Barbell)', 'sets' => 3, 'reps' => '8-10', 'notes' => 'Hinge at hips, keep back flat.'],
                            ['name' => 'Leg Press', 'sets' => 3, 'reps' => '10-12', 'notes' => 'Place feet lower for quad focus.'],
                            ['name' => 'Standing Calf Raise', 'sets' => 4, 'reps' => '10-15', 'notes' => 'Pause at the bottom for 1 second.'],
                        ]
                    ],
                    [
                        'day' => 'Wednesday',
                        'workout_name' => 'Rest & Recovery',
                        'exercises' => []
                    ],
                    [
                        'day' => 'Thursday',
                        'workout_name' => 'Pull (Hypertrophy)',
                        'exercises' => [
                            ['name' => 'Wide Grip Pull-Up (or Assisted)', 'sets' => 3, 'reps' => 'AMRAP', 'notes' => 'Full range of motion.'],
                            ['name' => 'Single Arm Cable Row', 'sets' => 3, 'reps' => '12-15', 'notes' => 'Get a deep stretch.'],
                            ['name' => 'Face Pulls', 'sets' => 3, 'reps' => '15-20', 'notes' => 'Focus on rear delts.'],
                            ['name' => 'Bayesian Cable Curl', 'sets' => 3, 'reps' => '12-15', 'notes' => 'Face away from the cable stack.'],
                        ]
                    ],
                    [
                        'day' => 'Friday',
                        'workout_name' => 'Push (Hypertrophy)',
                        'exercises' => [
                            ['name' => 'Machine Chest Press', 'sets' => 3, 'reps' => '10-12', 'notes' => 'Constant tension, do not lock out fully.'],
                            ['name' => 'Pec Deck Fly', 'sets' => 3, 'reps' => '12-15', 'notes' => 'Focus on the squeeze.'],
                            ['name' => 'Lateral Raise (Cable or DB)', 'sets' => 4, 'reps' => '15-20', 'notes' => 'Lead with elbows.'],
                            ['name' => 'Tricep Pressdown', 'sets' => 3, 'reps' => '12-15', 'notes' => 'Keep elbows pinned to sides.'],
                        ]
                    ],
                    [
                        'day' => 'Saturday',
                        'workout_name' => 'Legs (Hypertrophy)',
                        'exercises' => [
                            ['name' => 'Bulgarian Split Squat', 'sets' => 3, 'reps' => '10-12', 'notes' => 'Painful but effective.'],
                            ['name' => 'Leg Extension', 'sets' => 3, 'reps' => '15-20', 'notes' => 'Squeeze quads hard at the top.'],
                            ['name' => 'Lying Leg Curl', 'sets' => 3, 'reps' => '12-15', 'notes' => 'Control the weight on the way down.'],
                            ['name' => 'Seated Calf Raise', 'sets' => 3, 'reps' => '15-20', 'notes' => 'Higher rep range for soleus muscle.'],
                        ]
                    ],
                    [
                        'day' => 'Sunday',
                        'workout_name' => 'Rest',
                        'exercises' => []
                    ],
                ]
            ]),
        ]);


        Program::create([
            'name' => 'Intermediate Hypertrophy Ramping',
            'description' => 'A high-volume program designed for experienced lifters. Utilizes "Ramping" volume where sets increase week-over-week. Focuses on weak point training and metabolic stress.',
            'difficulty' => 'Advanced',
            'days_per_week' => 5,
            'routine_details' => json_encode([
                'split_name' => 'Upper / Lower / Pull / Push / Legs',
                'overview' => 'Frequency: 5 days/week. Focus: Volume ramping and advanced intensity techniques (Dropsets, Myo-reps).',
                'weekly_schedule' => [
                    [
                        'day' => 'Monday',
                        'workout_name' => 'Upper Body Power',
                        'exercises' => [
                            ['name' => 'Barbell Bench Press', 'sets' => 4, 'reps' => '5-8', 'notes' => 'Heavy compound movement.'],
                            ['name' => 'Pendlay Row', 'sets' => 4, 'reps' => '6-10', 'notes' => 'Explosive concentric.'],
                            ['name' => 'Seated Dumbbell Shoulder Press', 'sets' => 3, 'reps' => '8-12', 'notes' => 'Full range of motion.'],
                            ['name' => 'Weighted Dips', 'sets' => 3, 'reps' => '10-12', 'notes' => 'Target lower chest and triceps.'],
                        ]
                    ],
                    [
                        'day' => 'Tuesday',
                        'workout_name' => 'Lower Body Power',
                        'exercises' => [
                            ['name' => 'Squat (Low Bar or High Bar)', 'sets' => 4, 'reps' => '5-8', 'notes' => 'Primary strength mover.'],
                            ['name' => 'Hack Squat', 'sets' => 3, 'reps' => '10-12', 'notes' => 'Deep depth, constant tension.'],
                            ['name' => 'Romanian Deadlift', 'sets' => 3, 'reps' => '8-10', 'notes' => 'Heavy hinge movement.'],
                        ]
                    ],
                    [
                        'day' => 'Wednesday',
                        'workout_name' => 'Active Recovery',
                        'exercises' => [['name' => 'Light Cardio / Mobility', 'sets' => 1, 'reps' => '30 mins', 'notes' => 'Walk or cycle.']]
                    ],
                    [
                        'day' => 'Thursday',
                        'workout_name' => 'Pull (Hypertrophy Focus)',
                        'exercises' => [
                            ['name' => 'Pull-Ups', 'sets' => 4, 'reps' => 'Failure', 'notes' => 'Weighted if possible.'],
                            ['name' => 'Meadows Row', 'sets' => 3, 'reps' => '12-15', 'notes' => 'Unilateral upper back focus.'],
                            ['name' => 'Cable Pullover', 'sets' => 3, 'reps' => '15-20', 'notes' => 'Constant tension on lats.'],
                            ['name' => 'Preacher Curl', 'sets' => 3, 'reps' => '12-15', 'notes' => 'Focus on bicep peak.'],
                        ]
                    ],
                    [
                        'day' => 'Friday',
                        'workout_name' => 'Push (Hypertrophy Focus)',
                        'exercises' => [
                            ['name' => 'Incline Machine Press', 'sets' => 3, 'reps' => '10-15', 'notes' => 'Upper chest isolation.'],
                            ['name' => 'Lateral Raise (Machine)', 'sets' => 4, 'reps' => '15-20', 'notes' => 'Drop set on last set.'],
                            ['name' => 'Cable Fly', 'sets' => 3, 'reps' => '15-20', 'notes' => 'Focus on stretch and squeeze.'],
                            ['name' => 'Overhead Tricep Extension', 'sets' => 4, 'reps' => '12-15', 'notes' => 'Long head emphasis.'],
                        ]
                    ],
                    [
                        'day' => 'Saturday',
                        'workout_name' => 'Legs (Hypertrophy Focus)',
                        'exercises' => [
                            ['name' => 'Leg Press', 'sets' => 4, 'reps' => '15-20', 'notes' => 'High volume.'],
                            ['name' => 'Walking Lunges', 'sets' => 3, 'reps' => '12 steps/leg', 'notes' => 'Glute and quad finisher.'],
                            ['name' => 'Leg Extension', 'sets' => 3, 'reps' => '20+', 'notes' => 'Burnout set.'],
                            ['name' => 'Hamstring Curl', 'sets' => 4, 'reps' => '12-15', 'notes' => 'Control eccentric.'],
                        ]
                    ],
                    [
                        'day' => 'Sunday',
                        'workout_name' => 'Rest',
                        'exercises' => []
                    ],
                ]
            ]),
        ]);
    }
}
