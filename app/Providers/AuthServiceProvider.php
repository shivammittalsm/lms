<?php

namespace App\Providers;

use App\Models\Course;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Question;
use App\Models\User;
use App\Policies\CoursePolicy;
use App\Policies\QuestionPolicy;
use App\Policies\UserPolicy;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
     protected $policies = [
        Question::class => QuestionPolicy::class,
        Course::class => CoursePolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
        //
    }
}
