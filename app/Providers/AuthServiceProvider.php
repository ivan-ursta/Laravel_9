<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
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
         'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\BlogPost' => 'App\Policies\BlogPostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('home.secret', function($user) {
            return $user->is_admin;
    });

//        Gate::define('update-post', function ($user, $post) {
//            return $user->id == $post->user_id;
//        });
//
//        Gate::define('delete-post', function ($user, $post) {
//            return $user->id == $post->user_id;
//        });

//        Gate::define('posts.update', 'App\Policies\BlogPostPolicy@update');
//        Gate::define('posts.delete', 'App\Policies\BlogPostPolicy@delete');

        // Gate::resource('posts', 'App\Policies\BlogPostPolicy');
        // posts.create, posts.view, posts.update, posts.delete

        Gate::before(function ($user, $ability) {
           if($user->is_admin && in_array($ability, ['update', 'delete'])) {
               return true;
           }
        });
    }
}
