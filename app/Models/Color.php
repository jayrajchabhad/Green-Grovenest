<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Color extends Model
{
    protected $connection = 'mongodb';  // Ensure it connects to MongoDB
    protected $collection = 'colors';   // MongoDB collection name

    protected $fillable = [
        'name',
        'code',
        'status',
    ];
}
