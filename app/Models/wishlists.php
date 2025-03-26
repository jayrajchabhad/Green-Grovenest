<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class wishlists extends Model
{
    use HasFactory;


    protected $connection = 'mongodb'; // Ensure MongoDB is used

    protected $collection = 'wishlists'; // Your MongoDB coll

    protected $fillable = [
        'user_id',
        'product_id'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id','_id');
    }

}
