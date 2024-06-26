<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employees;
use App\Models\Clients;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
    
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
    
                switch ($user->userType) {
                    case 1:
                        return redirect(RouteServiceProvider::HOME);
                    case 2:
                        return redirect(RouteServiceProvider::EMPLOYEEHOME);
                    case 3:
                        // Handle user type 3 (Employee)
                        $employee = Employees::where('userId', $user->id)->first();
                        if (empty($employee->gender)) {
                            return redirect()->intended(RouteServiceProvider::SETPROFILEEMPLOYEE);
                        } else {
                            return redirect()->intended(RouteServiceProvider::EMPLOYEEHOME);
                        }
                    case 4:
                        // Handle user type 4 (Client)
                        $client = Clients::where('userId', $user->id)->first();
                        if (empty($client->gender)) {
                            return redirect()->intended(RouteServiceProvider::SETPROFILECLIENT);
                        } else {
                            return redirect()->intended(RouteServiceProvider::CLIENTHOME);
                        }
                    default:
                        return $next($request);
                }
            }
        }
    
        return $next($request);
    }
    
    
}
