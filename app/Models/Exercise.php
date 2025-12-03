<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'muscle_group',
        'type',
        'equipment',
        'instructions',
        'video_url',
        'image_path',
    ];
}
