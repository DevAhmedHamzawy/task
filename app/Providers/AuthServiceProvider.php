<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /* define a admin user role */
        Gate::define('admin', function($user) {
            return $user->role == 'admin';
         });
        
         /* define a manager user role */
         Gate::define('save', function($user) {
             return $user->role == 'save';
         });
       
         /* define a user role */
         Gate::define('details', function($user) {
             return $user->role == 'details';
         });

          /* define a user role */
          Gate::define('show', function($user) {
            return $user->role == 'show';
        });

    }
}
