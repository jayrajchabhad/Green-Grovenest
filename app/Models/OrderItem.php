<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\Order;


class OrderItem extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'order_items'; 

    protected $fillable = [

        'order_id',
        'product_id' ,
        'product_color_id',
        'quantity',       
        'price'
        
    ];

    public function productColor () 
    {
        return $this->belongsTo(ProductColor::class,'product_color_id','_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', '_id');
    }
    public function product() :BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id','_id');
    }
  

}

