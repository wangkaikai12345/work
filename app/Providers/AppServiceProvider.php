<?php

namespace App\Providers;

use App\Comment;
use App\Observers\UserObserver;
use App\Observers\WorkObserver;
use App\Observers\CommentObserver;
use App\User;
use App\Work;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Work::observe(WorkObserver::class);
        Comment::observe(CommentObserver::class);
//        User::observe(UserObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
