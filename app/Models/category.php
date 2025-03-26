<?php

namespace App\Models;

use App\Models\Product;
use MongoDB\Laravel\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class category extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'categories';

    protected $primaryKey = '_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'meta_titel',
        'meta_keyword',
        'meta_description',
        'status',
        'electronics',
        'sports',

    ];
    public function products(){
        return $this->hasMany(Product::class,'category_id','_id');
    }
    public function reletedproducts(){
        return $this->hasMany(Product::class,'category_id','_id')->latest()->take(8);
    }
    public function brands(){
        return $this->hasMany(Brand::class,'category_id','_id')->where('status','0');
    }
}
