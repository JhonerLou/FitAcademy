<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('muscle_group', [
                'Chest',
                'Back',
                'Shoulders',
                'Biceps',
                'Triceps',
                'Quadriceps',
                'Hamstrings',
                'Glutes',
                'Calves',
                'Abs'
            ]);
            $table->enum('type', ['Compound', 'Isolation']);
            $table->enum('equipment', ['Barbell', 'Dumbbell', 'Machine', 'Cable', 'Bodyweight']);
            $table->text('instructions');
            $table->string('video_url')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
