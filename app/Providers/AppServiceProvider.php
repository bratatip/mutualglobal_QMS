<?php

namespace App\Providers;

use App\Http\Composers\NavbarComposer;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // View::composer(['layouts.admin_header', 'layouts.employee_header'], function ($view){
        //     $data = Category::with('products')->get();
        //     $view->with('products', $data);
        // });

        view::composer(['layouts.employee_header','layouts.admin_header'], NavbarComposer::class);
    }
}
