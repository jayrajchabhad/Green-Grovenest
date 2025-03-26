<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class ProductColor extends Model
{
    protected $connection = 'mongodb';
    protected $primaryKey = '_id'; // MongoDB uses _id

    protected $collection = 'product_colors';

    protected $fillable = [
        'product_id',
        'color_id',
        'quantity',
    ];

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id', '_id'); // For MongoDB
    }
    
}
