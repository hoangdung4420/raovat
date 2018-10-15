<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\ParentCategory;
use App\ChildCategory;
use App\District;
use App\Village;
use App\Street;
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
        View::share('childCats', ChildCategory::all());
        View::share('districts', District::all());
        View::share('villages', Village::all());
        View::share('streets', Street::all());
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
