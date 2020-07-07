<?php

namespace App\Providers;

use App\Policies\QuestionPolicy;
use App\Question;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Question::class => QuestionPolicy::class // added my me
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // Added by me
//        \Gate::define('update-questions',function($user,$question){
//            return $user->id == $question->user_id;
//        });
//
//        \Gate::define('delete-questions',function($user,$question){
//            return $user->id == $question->user_id;
//        });
    }
}
