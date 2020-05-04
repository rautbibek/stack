<?php

namespace App\Providers;
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
        \App\Question::class => \App\Policies\QuestionPolicy::class,
        \App\Answer::class => \App\Policies\AnswerPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        
        $this->registerPolicies();

        // Gate::define('update-question', function ($user, $question) {
        //     return $user->id === $question->user_id;
        // });

        // Gate::define('delete-question', function ($user, $question) {
        //     return $user->id === $question->user_id;
        // });
        
    }
}
