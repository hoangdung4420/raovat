<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\ParentCategory;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('PublicUrl', getenv('TEMPLATE_PUBLIC_URL'));
        View::share('AdminUrl', getenv('TEMPLATE_ADMIN_URL'));
        View::share('parentCats', ParentCategory::all());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
