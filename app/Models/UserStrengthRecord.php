<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class UserStrengthRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exercise',
        'weight_lifted',
        'reps_performed',
        'estimated_1rm',
        'strength_level',
        'recorded_at',
    ];

    protected $casts = [
        'recorded_at' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
