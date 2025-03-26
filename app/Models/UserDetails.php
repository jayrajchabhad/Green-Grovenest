<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDetails extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';

    protected $table = 'user_details';

    protected $fillable = [
        'user_id',
        'phone',
        'pin_code',
        'address',
       
    ];    
}
