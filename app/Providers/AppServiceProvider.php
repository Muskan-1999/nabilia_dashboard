<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;


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
        // // Priority to logged-in user preference
        // if (Auth::check() && Auth::user()->locale) {
        //     app()->setLocale(Auth::user()->locale);
        // } elseif (Session::has('locale')) {
        //     app()->setLocale(Session::get('locale'));
        // } else {
        //     app()->setLocale(config('app.locale'));
        // }
    }
}
