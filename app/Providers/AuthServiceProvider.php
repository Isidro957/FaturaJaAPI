<?php

namespace App\Providers;

#use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    #$this->registerPolicies();
    $this->registerPostsPolicies();
  }

  public function registerPostsPolicies(): void
  {
    Gate::define('super-admin-post',function($user){
     return  $user->hasAccess(['super-admin-post']);
    });

    Gate::define('admin-post',function($user){
     return  $user->hasAccess(['admin-post']);
    });

    Gate::define('user-post',function($user){
     return  $user->hasAccess(['user-post']);
    });

    Gate::define('estagiario-post', function($user){
      return $user->hasAccess(['estagiario-post']);
    });

    Gate::define('supervi-post', function($user){
      return $user->hasAccess(['supervi-post']);
    });

    Gate::define('create-post', function($user){
      return $user->hasAccess(['create-post']);
    });

    Gate::define('publish-post',function($user){
      return $user->hasAccess(['publish-post']);
    });

    Gate::define('gci-post',function($user){
      return $user->hasAccess(['gci-post']);
    });

    Gate::define('rh-post',function($user){
      return $user->hasAccess(['rh-post']);
    });

    Gate::define('gti-post',function($user){
      return $user->hasAccess(['gti-post']);
    });

    Gate::define('online-post',function($user){
      return $user->hasAccess(['online-post']);
    });

  }
}
