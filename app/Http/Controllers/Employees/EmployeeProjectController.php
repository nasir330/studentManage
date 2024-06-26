<?php

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLog;
use App\Models\Project;
use App\Models\ProjectManage;
use App\Models\User;
use App\Models\WorkLog;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class EmployeeProjectController extends Controller
{
    public function index($employee_id)
    {
        // $clientId = ProjectManage::where('employeeId',Auth::user()->id)->first();
        $workLog = WorkLog::where('employeeId', Auth::user()->id)
            ->where('end_time', null)
            ->first();
        $projects = ProjectManage::where('employeeId', Auth::user()->id)->get();
        $dateToday = Date::today();
        $data = WorkLog::where('employeeId', Auth::user()->id)
            ->whereDate('start_time', $dateToday)
            ->get();
        // $employee_id = your_employee_id_value_here; // Replace with the actual employee ID

        // $exists = Post::where('content', 'LIKE', '%example%')->exists();
        $latest = EmployeeLog::where('employeeId', $employee_id)
            ->orderBy('id', 'desc')
            ->first();
        $exists = false; // Initialize $exists with a default value
        if (!empty($latest->status)) {
            if (strpos($latest->status, 'Break') !== false) {
                $exists = true;
            } else {
                $exists = false;
            }
        }

        return view('employees.projects.index', ['projects' => $projects, 'data' => $data, 'workLog' => $workLog, 'exists' => $exists, 'latest' => $latest]);
        // return $exists;
    }

    public function workLogs(Request $request)
    {
        $employeeId = Auth::user()->id;
        $startTime = Carbon::now()->setTimezone('Asia/Dhaka');
        $clientId = Project::where('id', $request->projectId)->first()->clientId;
        WorkLog::create([
            'employeeId' => $employeeId,
            'clientId' => $clientId,
            'projectId' => $request->projectId,
            'start_time' => $startTime,
        ]);

        EmployeeLog::create([
            'projectId' => $request->projectId,
            'employeeId' => $employeeId,
            'status' => 'start',
            'time' => $startTime,
        ]);

        // Flash a success message and redirect back
        session()->flash('success', 'Project Successfully started..!!');
        return redirect()->back();
    }
    // submit work break
    public function workBreak(Request $request)
    {
        //    return $request->all();
        $breakTime = Carbon::now()->setTimezone('Asia/Dhaka');
        $employeeId = Auth::user()->id;
        // dd(Auth::user()->id);
        EmployeeLog::create([
            'projectId' => $request->projectId,
            'employeeId' => $employeeId,
            'status' => $request->type,
            'time' => $breakTime,
        ]);

        session()->flash('success', 'Break Submitted!');
        return redirect()->back();
    }

    public function workLogHistory()
    {
        $employeeLogs = EmployeeLog::with('project')
            ->where('employeeId', Auth::user()->id)
            ->get();
        return view('employees.projects.workLogHistory', [
            'employeeLogs' => $employeeLogs,
        ]);
    }

    public function updateStatus(Request $request)
    {
        EmployeeLog::create([
            'projectId' => $request->projectId,
            'employeeId' => $request->employeeId,
            'status' => 'back',
            'time' => Carbon::now()->setTimezone('Asia/Dhaka'),
        ]);
        return redirect()->back();
    }

    public function endOfDayStatus($projectId)
    {
        EmployeeLog::create([
            'projectId' => $projectId,
            'employeeId' => Auth::user()->id,
            'status' => 'end',
            'time' => Carbon::now()->setTimezone('Asia/Dhaka'),
        ]);

        WorkLog::where('projectId', $projectId)
            ->where('employeeId', Auth::user()->id)
            ->where('clientId', Project::where('id', $projectId)->first()->clientId)
            ->orderBy('id', 'desc')
            ->first()
            ->update([
                'end_time' => Carbon::now()->setTimezone('Asia/Dhaka'),
            ]);

        return redirect()->back();
    }
}
