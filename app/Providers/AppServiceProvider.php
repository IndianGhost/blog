<?php

namespace App\Providers;

use App\Services\PostService;
use App\Services\PostServiceImpl;
use App\Services\UserService;
use App\Services\UserServiceImpl;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind(UserService::class, UserServiceImpl::class);
        $this->app->bind(PostService::class, PostServiceImpl::class);
    }

}
