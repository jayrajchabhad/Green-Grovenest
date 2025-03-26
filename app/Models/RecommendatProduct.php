<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecommendatProduct extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';

    protected $table = 'recommendat_product';

    protected $fillable = ['product_id', 'recommended_product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function recommendedProduct()
    {
        return $this->belongsTo(Product::class, 'recommended_product_id');
    }

}
