<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContectUsDetail extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';

    protected $table = "contact_us_detail";

    protected $fillable = [
        "name",
        "email",
        "phone",
        "message",
        "reply",
    ];    
        
}
