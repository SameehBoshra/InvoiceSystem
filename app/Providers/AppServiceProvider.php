<?php

namespace App\Providers;

use App\repositories\departmentRepository\departmentRepository;
use App\repositories\departmentRepository\interfaces\iDepartmentRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(iDepartmentRepository::class,departmentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
