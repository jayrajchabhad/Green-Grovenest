<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{

    
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'brands';

    protected $primaryKey = '_id'; // Use MongoDB's _id
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'name',
        'slug',
        'status',
        'category_id',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','_id');   
    }
}

