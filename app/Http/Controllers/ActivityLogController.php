<?php

namespace App\Http\Controllers;

use App\Models\EmployeeLog;
use App\Models\WorkLog;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function showWorkLog(){
        $workLog = WorkLog::all();
        return view('superAdmin.activityLog.workLog',['workLog' => $workLog]);
    }

    public function showEmployeeLog(){
        $employeeLog = EmployeeLog::all();
        return view('superAdmin.activityLog.employeeLog',['employeeLog' => $employeeLog]);
    }

    public function index(){
        $activityLog = ActivityLog::all();
        return view('superAdmin.reports.index',['activityLog' => $activityLog]);
            
    }
}