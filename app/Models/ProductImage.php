<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductImage extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';

    protected $collection = 'product_images';
    protected $primaryKey = '_id';
    protected $fillable = [
        'product_id',
        'image',


    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', '_id');
    }


}
