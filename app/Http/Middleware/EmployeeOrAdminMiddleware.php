<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeOrAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('employee')) {
                $user = auth()->user();
                // return redirect()->route('customer.table');
                return $next($request);
            } else {
                Auth::logout();
                return redirect()->to('/');
            }
        }
        $errorMessage = "Unauthorized Access !  Please Do Contact With Admin ";
        return back()->with('error', 'You do not have the required role to access this page.');
        // return abort(403, 'Unauthorized Access ! You may Reported to the server Admin !');
    }
}
