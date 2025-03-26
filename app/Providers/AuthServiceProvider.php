<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Event; // ✅ Import Event facade
use Illuminate\Auth\Events\Verified; // ✅ Import Verified event

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        // ✅ Correct way to listen to the Verified event
        Event::listen(Verified::class, function ($event) {
            session()->flash('success', 'Your email has been verified!');
        });
    }
}
