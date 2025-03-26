<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupons extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $collection = 'coupons'; // Ensure this matches your MongoDB collection name

    protected $fillable = [
        "code",
        "discount_percentage",
        "upto_price",
        "valid_from",
        "valid_until",
        "is_active",
        
    ];
}
