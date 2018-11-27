<?php

namespace App\Providers;

use App\Comment;
use App\Love;
use App\Policies\LovePolicy;
use App\Policies\SystemPolicy;
use App\Policies\TypePolicy;
use App\Policies\UserPolicy;
use App\Policies\WorkPolicy;
use App\Policies\CommentPolicy;
use App\System;
use App\Type;
use App\User;
use App\Work;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
         Work::class => WorkPolicy::class,
         Type::class => TypePolicy::class,
         System::class => SystemPolicy::class,
         Love::class => LovePolicy::class,
         User::class => UserPolicy::class,
         Comment::class => CommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
