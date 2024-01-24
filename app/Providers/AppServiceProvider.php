<?php

namespace App\Providers;

use App\Http\Controllers\ChallengesController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\ProgramsParticipantsController;
use App\Http\Controllers\UsersController;
use App\Models\Challenges;
use App\Models\Companies;
use App\Models\Programs;
use App\Models\ProgramsParticipants;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UsersController::class, function ($app) {
            return new UsersController($app->make(User::class));
        });

        $this->app->bind(ChallengesController::class, function ($app) {
            return new ChallengesController($app->make(Challenges::class));
        });

        $this->app->bind(CompaniesController::class, function ($app) {
            return new CompaniesController($app->make(Companies::class));
        });

        $this->app->bind(ProgramsController::class, function ($app) {
            return new ProgramsController($app->make(Programs::class));
        });

        $this->app->bind(ProgramsParticipantsController::class, function ($app) {
            return new ProgramsParticipantsController($app->make(ProgramsParticipants::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
