<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employees;

class DashboardController extends Controller
{
    //project information
    public function projectDashboard()
    {
        //check auth type
        $authCheck = Auth::user()->userType;
        if ($authCheck == 1) {
            $employees = Employees::where('id', '!=', 1)
                ->with([
                    'employeeLogs' => function ($query) {
                        $query->orderBy('created_at', 'desc')->limit(1);
                    },
                ])
                ->get();

            return view('dashboard', ['employees' => $employees]);
        }
    }
}
