<?php

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    public function run(): void
    {


        $exercises = [

            [
                'name' => '45° Incline Barbell Press',
                'muscle_group' => 'Chest',
                'type' => 'Compound',
                'equipment' => 'Barbell',
                'instructions' => "Target: Upper chest (Front deltoid, triceps)\n\nGerakan mendorong barbell pada sudut incline untuk menekankan dada atas.\n\nScience Tip: Sudut incline meningkatkan activation upper chest dan menjaga TENSION lebih optimal.",
                'video_url' => 'https://www.muscleandstrength.com/exercises/incline-bench-press.html',
                'image_path' => 'https://placehold.co/600x400/10b981/ffffff?text=Incline+Press',
            ],
            [
                'name' => 'Machine Chest Press',
                'muscle_group' => 'Chest',
                'type' => 'Compound',
                'equipment' => 'Machine',
                'instructions' => "Target: Chest (Triceps, front deltoid)\n\nVersi mesin dari bench press dengan stabilitas tinggi.\n\nScience Tip: Mesin memberikan TENSION yang lebih stabil dibanding free weight.",
                'video_url' => 'https://www.muscleandstrength.com/exercises/machine-chest-press.html',
                'image_path' => 'https://placehold.co/600x400/10b981/ffffff?text=Chest+Press',
            ],
            [
                'name' => 'Pec Deck Fly',
                'muscle_group' => 'Chest',
                'type' => 'Isolation',
                'equipment' => 'Machine',
                'instructions' => "Target: Chest (Front deltoid)\n\nGerakan adduksi lengan untuk fokus kontraksi dada.\n\nScience Tip: Cocok untuk loaded stretch pada fase negatif.",
                'video_url' => 'https://www.muscleandstrength.com/exercises/pec-deck.html',
                'image_path' => 'https://placehold.co/600x400/10b981/ffffff?text=Pec+Deck',
            ],

     
            [
                'name' => 'Neutral-Grip Lat Pulldown',
                'muscle_group' => 'Back',
                'type' => 'Compound',
                'equipment' => 'Cable',
                'instructions' => "Target: Latissimus dorsi (Biceps, mid-back)\n\nMenarik handle ke arah dada untuk aktivasi lats.\n\nScience Tip: Grip netral meningkatkan TENSION merata pada lats.",
                'video_url' => 'https://www.muscleandstrength.com/exercises/neutral-grip-lat-pulldown.html',
                'image_path' => 'https://placehold.co/600x400/3b82f6/ffffff?text=Lat+Pulldown',
            ],
            [
                'name' => 'Pendlay Deficit Row',
                'muscle_group' => 'Back',
                'type' => 'Compound',
                'equipment' => 'Barbell',
                'instructions' => "Target: Mid-back (Lats, rear delts)\n\nRow dari posisi bawah dengan sudut tubuh mendatar.\n\nScience Tip: Fokus pada long muscle length untuk stimulasi hipertrofi.",
                'video_url' => 'https://www.muscleandstrength.com/exercises/pendlay-row.html',
                'image_path' => 'https://placehold.co/600x400/3b82f6/ffffff?text=Pendlay+Row',
            ],
            [
                'name' => 'Chest-Supported Machine Row',
                'muscle_group' => 'Back',
                'type' => 'Compound',
                'equipment' => 'Machine',
                'instructions' => "Target: Mid-back (Biceps)\n\nGerakan menarik dengan dada disangga.\n\nScience Tip: Mengurangi cheating dan menjaga TENSION tetap konstan.",
                'video_url' => 'https://www.muscleandstrength.com/exercises/machine-row.html',
                'image_path' => 'https://placehold.co/600x400/3b82f6/ffffff?text=Machine+Row',
            ],


            [
                'name' => 'High-Cable Lateral Raise',
                'muscle_group' => 'Shoulders',
                'type' => 'Isolation',
                'equipment' => 'Cable',
                'instructions' => "Target: Side deltoid (Upper traps)\n\nMengangkat lengan ke samping menggunakan kabel.\n\nScience Tip: Kabel menjaga TENSION aktif sepanjang ROM.",
                'video_url' => 'https://www.muscleandstrength.com/exercises/one-arm-cable-lateral-raise.html',
                'image_path' => 'https://placehold.co/600x400/f59e0b/ffffff?text=Cable+Raise',
            ],
            [
                'name' => 'Machine Shoulder Press',
                'muscle_group' => 'Shoulders',
                'type' => 'Compound',
                'equipment' => 'Machine',
                'instructions' => "Target: Front deltoid (Triceps, side deltoid)\n\nTekanan vertikal untuk bahu depan dan samping.\n\nScience Tip: Mesin meningkatkan stabilitas dan efisiensi TENSION.",
                'video_url' => 'https://www.muscleandstrength.com/exercises/machine-shoulder-press.html',
                'image_path' => 'https://placehold.co/600x400/f59e0b/ffffff?text=Shoulder+Press',
            ],
            [
                'name' => '1-Arm 45° Cable Rear Delt Fly',
                'muscle_group' => 'Shoulders',
                'type' => 'Isolation',
                'equipment' => 'Cable',
                'instructions' => "Target: Rear deltoid (Mid-back)\n\nFly satu tangan untuk bahu belakang.\n\nScience Tip: Rear delt perlu isolasi karena sering tertutupi lats.",
                'video_url' => 'https://www.muscleandstrength.com/exercises/one-arm-cable-rear-delt-fly.html',
                'image_path' => 'https://placehold.co/600x400/f59e0b/ffffff?text=Rear+Delt+Fly',
            ],


            [
                'name' => 'Bayesian Cable Curl',
                'muscle_group' => 'Biceps',
                'type' => 'Isolation',
                'equipment' => 'Cable',
                'instructions' => "Target: Biceps (Brachialis)\n\nCurl dengan posisi tubuh maju untuk stretch maksimal.\n\nScience Tip: Memberikan TENSION tinggi pada posisi panjang otot.",
                'video_url' => 'https://www.muscleandstrength.com/exercises/standing-one-arm-cable-curl.html',
                'image_path' => 'https://placehold.co/600x400/ef4444/ffffff?text=Cable+Curl',
            ],
            [
                'name' => 'Machine Preacher Curl',
                'muscle_group' => 'Biceps',
                'type' => 'Isolation',
                'equipment' => 'Machine',
                'instructions' => "Target: Biceps (Brachialis)\n\nCurl dengan sandaran lengan untuk fokus ke biceps.\n\nScience Tip: Mengurangi momentum dan meningkatkan TENSION lokal.",
                'video_url' => 'https://www.muscleandstrength.com/exercises/machine-preacher-curl.html',
                'image_path' => 'https://placehold.co/600x400/ef4444/ffffff?text=Preacher+Curl',
            ],
            [
                'name' => 'Overhead Cable Triceps Extension',
                'muscle_group' => 'Triceps',
                'type' => 'Isolation',
                'equipment' => 'Cable',
                'instructions' => "Target: Triceps long head (Triceps lateral head)\n\nTriceps extension dari posisi lengan di atas kepala.\n\nScience Tip: Posisi overhead memberi loaded stretch maksimal.",
                'video_url' => 'https://www.muscleandstrength.com/exercises/high-pulley-overhead-tricep-extension.html',
                'image_path' => 'https://placehold.co/600x400/ef4444/ffffff?text=Triceps+Ext',
            ],
            [
                'name' => 'Triceps Pressdown (Bar)',
                'muscle_group' => 'Triceps',
                'type' => 'Isolation',
                'equipment' => 'Cable',
                'instructions' => "Target: Triceps (Forearm)\n\nMenekan bar ke bawah untuk meluruskan siku.\n\nScience Tip: Kontrol fase negatif untuk mempertahankan TENSION.",
                'video_url' => 'https://www.muscleandstrength.com/exercises/tricep-pushdown.html',
                'image_path' => 'https://placehold.co/600x400/ef4444/ffffff?text=Pressdown',
            ],


            [
                'name' => 'Smith Machine Squat',
                'muscle_group' => 'Quadriceps',
                'type' => 'Compound',
                'equipment' => 'Machine',
                'instructions' => "Target: Quadriceps (Glutes, adductors)\n\nSquat dengan lintasan tetap untuk stabilitas tinggi.\n\nScience Tip: Stabilitas tinggi membantu fokus TENSION ke quads.",
                'video_url' => 'https://www.muscleandstrength.com/exercises/smith-machine-squat.html',
                'image_path' => 'https://placehold.co/600x400/8b5cf6/ffffff?text=Smith+Squat',
            ],
            [
                'name' => 'Leg Extension',
                'muscle_group' => 'Quadriceps',
                'type' => 'Isolation',
                'equipment' => 'Machine',
                'instructions' => "Target: Quadriceps\n\nMeluruskan kaki untuk isolasi quads.\n\nScience Tip: Efektif untuk menarget rectus femoris secara spesifik.",
                'video_url' => 'https://www.muscleandstrength.com/exercises/leg-extension.html',
                'image_path' => 'https://placehold.co/600x400/8b5cf6/ffffff?text=Leg+Extension',
            ],
            [
                'name' => 'Barbell Romanian Deadlift (RDL)',
                'muscle_group' => 'Hamstrings',
                'type' => 'Compound',
                'equipment' => 'Barbell',
                'instructions' => "Target: Hamstrings (Glutes, lower back)\n\nHip hinge dengan fokus peregangan hamstrings.\n\nScience Tip: Menempatkan TENSION tinggi pada otot dalam posisi panjang.",
                'video_url' => 'https://www.muscleandstrength.com/exercises/romanian-deadlift.html',
                'image_path' => 'https://placehold.co/600x400/8b5cf6/ffffff?text=RDL',
            ],
            [
                'name' => 'DB Bulgarian Split Squat',
                'muscle_group' => 'Quadriceps',
                'type' => 'Compound',
                'equipment' => 'Dumbbell',
                'instructions' => "Target: Quads, glutes (Hamstrings)\n\nSplit squat satu kaki dengan kaki belakang ditinggikan.\n\nScience Tip: Memberi TENSION unilateral dan meningkatkan stabilitas.",
                'video_url' => 'https://www.muscleandstrength.com/exercises/one-leg-dumbbell-squat-aka-bulgarian-squat.html',
                'image_path' => 'https://placehold.co/600x400/8b5cf6/ffffff?text=Split+Squat',
            ],
            [
                'name' => 'Standing Calf Raise',
                'muscle_group' => 'Calves',
                'type' => 'Isolation',
                'equipment' => 'Machine',
                'instructions' => "Target: Calves (Soleus)\n\nGerakan plantar flexion untuk betis.\n\nScience Tip: Pause di posisi atas menjaga TENSION optimal.",
                'video_url' => 'https://www.muscleandstrength.com/exercises/standing-machine-calf-raise.html',
                'image_path' => 'https://placehold.co/600x400/8b5cf6/ffffff?text=Calf+Raise',
            ],


            [
                'name' => 'Cable Crunch',
                'muscle_group' => 'Abs',
                'type' => 'Isolation',
                'equipment' => 'Cable',
                'instructions' => "Target: Rectus abdominis (Obliques)\n\nCrunch dengan resistensi kabel.\n\nScience Tip: Kabel memberikan TENSION progresif sepanjang gerakan.",
                'video_url' => 'https://www.muscleandstrength.com/exercises/cable-crunch.html',
                'image_path' => 'https://placehold.co/600x400/ec4899/ffffff?text=Cable+Crunch',
            ],
            [
                'name' => 'Roman Chair Leg Raise',
                'muscle_group' => 'Abs',
                'type' => 'Isolation',
                'equipment' => 'Bodyweight',
                'instructions' => "Target: Lower abs (Hip flexor)\n\nMengangkat kaki untuk aktivasi perut bawah.\n\nScience Tip: Kontrol negatif meningkatkan TENSION dan stimulus.",
                'video_url' => 'https://www.muscleandstrength.com/exercises/roman-chair-leg-raise.html',
                'image_path' => 'https://placehold.co/600x400/ec4899/ffffff?text=Leg+Raise',
            ],
            [
                'name' => 'Ab Wheel Rollout',
                'muscle_group' => 'Abs',
                'type' => 'Compound',
                'equipment' => 'Bodyweight',
                'instructions' => "Target: Core depan (Bahu, lats)\n\nRoll out untuk stabilisasi dan kekuatan inti.\n\nScience Tip: Memberi TENSION tinggi pada seluruh core anterior.",
                'video_url' => 'https://www.muscleandstrength.com/exercises/ab-wheel-rollout.html',
                'image_path' => 'https://placehold.co/600x400/ec4899/ffffff?text=Ab+Rollout',
            ],
        ];

        foreach ($exercises as $exercise) {
            Exercise::create($exercise);
        }
    }
}
