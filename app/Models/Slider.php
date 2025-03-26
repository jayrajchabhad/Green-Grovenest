<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';


    protected $table = "slider";
    protected $fillable = [
        'title',
        'description',
        'image',
        'status'
    ];

}
