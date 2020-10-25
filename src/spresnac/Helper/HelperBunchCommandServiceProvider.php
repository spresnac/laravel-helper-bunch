<?php

namespace spresnac\Helper;

use App\Helper\PasswordResetHelper;
use Illuminate\Support\ServiceProvider;

class HelperBunchCommandServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                DatesHelper::class,
                PaginationHelper::class,
                PasswordResetHelper::class,
            ]);
        }
    }
}
