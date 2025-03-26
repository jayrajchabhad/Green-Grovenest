<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'reviews'; 

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'review',
        'Approved',
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
