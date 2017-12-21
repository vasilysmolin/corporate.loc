<?php

namespace Corp\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Corp\Article;
use Corp\Policies\ArticlePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Corp\Model' => 'Corp\Policies\ModelPolicy',
//        Article::class =>'ArticlePolicy',
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
//        $gate->define('VIEW_ADMIN', function($user){
//
//            return $user->canDo('VIEW_ADMIN');
//
//        });


    }
}
