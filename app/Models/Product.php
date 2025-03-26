<?php

namespace App\Models;

use App\Models\ProductImage;
use App\Models\ProductColor;
use MongoDB\Laravel\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $collection = 'products';
    protected $primaryKey = '_id';
    
    protected $fillable = [
        "category_id",
        "name",
        "slug",
        "brand",
        "small_description",
        "description",
        "original_price",
        "selling_price",
        "quantity",
        "trending",
        "featured",
        "status",
        "meta_title",
        "meta_keyword",
        "meta_description",
    ];



    public function averageRating()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', '_id');
    }


    public function category()
    {
        return $this->belongsTo(Category::class,"category_id","_id");
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class,"product_id","_id");
    }
 
    public function productColors()
    {
        return $this->hasMany(ProductColor::class,"product_id","_id");
    }



}
