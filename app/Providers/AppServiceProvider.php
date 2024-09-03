<?php

namespace App\Providers;

use App\Models\JobListing;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
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
    public function boot(): void
    {
        // Gate::define('user-edit',function(User $user, JobListing $job){  //$user is current login user
            
        //     return  $job->employer->user->is($user);  // this will return a boolean value
        //  });

         Gate::define('job-create',function(User $user){  //$user is current login user
            
            return $user;
        
        });
    }
}
