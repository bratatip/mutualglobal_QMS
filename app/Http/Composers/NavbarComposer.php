<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class NavbarComposer
{
    public function compose(View $view)
    {
        if (auth()->user()->hasRole('admin')) {
            $data = Category::with('products')->get();
            $view->with('navbarData', $data);
        } elseif (auth()->user()->hasRole('employee')) {
            $data = Category::with('products')->get();
            $view->with('navbarData', $data);
        }

    }
}
