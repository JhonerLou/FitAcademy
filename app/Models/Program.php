<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'difficulty', // Enum: Beginner, Intermediate, Advanced
        'days_per_week',
        'routine_details', // LongText
    ];
}
