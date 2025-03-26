<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use MongoDB\Client;
use App\Models\ContectUsDetail;
use App\Models\Contact;


class AppServiceProvider extends ServiceProvider
{
    protected $collection; // Define the collection property

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
{
    // Use Bootstrap pagination
    Paginator::useBootstrap();

    // MongoDB Atlas Connection
    $client = new Client(env('DB_URI'));
    
    // Select the correct database
    $database = $client->selectDatabase(env('DB_DATABASE', 'maraketnest'));
    $this->collection = $database->settings;

    // Share settings globally
    $websiteSetting = $this->collection->findOne([]);
    
    if ($websiteSetting) {
        View::share('appSetting', $websiteSetting);
    } else {
        View::share('appSetting', null);
    }

    // Fetch contact data
    $contactData = ContectUsDetail::orderBy('created_at', 'desc')->get();
    View::share('contactData', $contactData);
}
}