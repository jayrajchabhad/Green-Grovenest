<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Product;  
use App\Models\ProductColor;

class cart extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'carts';

    protected $fillable = [
        "user_id",
        "product_id",
        "product_color_id",
        "quantity",
    ];    
    
    public function product() 
    {
        return $this->belongsTo(Product::class,'product_id','_id');
    }

    public function productColor () 
    {
        return $this->belongsTo(ProductColor::class,'product_color_id','_id');
    }

}
