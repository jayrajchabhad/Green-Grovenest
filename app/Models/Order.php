<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\OrderItem;


class Order extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $table = "orders";

    protected $fillable = [

            'user_id'       ,          
            'tracking_no'   ,
            'fullname'      ,     
            'email'         ,      
            'phone'         ,       
            'pincode'       ,
            'address'       ,
            'status_message',
            'payment_mode'  ,
            'payment_id'    ,
            'original_price',
            'discount_price',
            'total_amount',
    ];
    public function oredrItems() : HasMany
    {
        return $this->hasMany(OrderItem::class,'order_id','_id');
    }
}
