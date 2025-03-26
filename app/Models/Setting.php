<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    

    use HasFactory;

    
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mongodb';

    /**
     * The collection associated with the model.
     *
     * @var string
     */
    protected $collection = 'settings';

    protected $fillable = [
        "website_name",
        "website_url",
        "title",
        "meta_keywords",
        "meta_description",
        "address",
        "phone1",
        "phone2",
        "email1",
        "email2",
        "facebook",
        "twitter",
        "instagram",
        "youtube",
        "about_title",
        "about_description",
        "p_1",
        "p_2",
        "p_3",
        "p_4",
        "about_img",
        "latitude",
        "longitude",
        "primary",
        "button",
        "header_footer",
        "line",
        "home",
        "font_style",
        "web_logo"
    ];
}
