<?php

namespace App\Providers;

use App\Models\Job;
use App\Observers\JobObserver;
use Domain\Tasks\Models\Task;
use Domain\Tasks\Observers\TaskObserver;
use Illuminate\Support\ServiceProvider;

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
        Task::observe(TaskObserver::class);
    }
}
