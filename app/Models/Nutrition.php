<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Nutrition extends Model
{
    use HasFactory;

    protected $table = 'nutritions';

    protected $fillable = [
        'name',
        'category',
        'description',
        'dosage',
        'calories_per_serving',
    ];
}
