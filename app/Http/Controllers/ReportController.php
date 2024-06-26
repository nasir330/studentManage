<?php

namespace App\Http\Controllers;

use App\Models\EmployeeLog;
use App\Models\ProjectManage;
use App\Models\WorkLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index() {
        $workLogs = ProjectManage::all();
    
        $date = Carbon::now()->format('Y-m-d');
    
        $breakDurationsArray = [];

        $totalDurationsArray = [];

        $actualDutyDurationsArray = [];
    
        foreach ($workLogs as $workLog) {
            $breaks = DB::table('employee_logs')
                ->where('employeeId', $workLog->employeeId)
                ->where('projectId', $workLog->projectId)
                ->whereDate('time', $date)
                ->orderBy('time')
                ->get();
            
            $totalBreakDurations = 0;
            $startTime = null;
            $totalDurations = 0;
            $startDutyTime = null;
            foreach ($breaks as $break) {
                // calculating totalBreakDuration 
                if ($break->status === 'Prayers_Break' || $break->status === 'Lunch_Break' || $break->status === 'Others_Break' || $break->status === 'Dinner_Break') {
                    $startTime = Carbon::parse($break->time);
                } elseif ($break->status === 'back') {
                    if ($startTime) {
                        $endTime = Carbon::parse($break->time);
                        $breakDuration = $endTime->diff($startTime);
                        $totalBreakDurations += $breakDuration->s + ($breakDuration->i * 60) + ($breakDuration->h * 3600);
                    }
                }
                // calculating totalDuration 
                if ($break->status === 'start') {
                    $startDutyTime = Carbon::parse($break->time);
                } elseif ($break->status === 'end') {
                    if ($startDutyTime) {
                        $endDutyTime = Carbon::parse($break->time);
                        $totalDuration = $endDutyTime->diff($startDutyTime);
                        $totalDurations += $totalDuration->s + ($totalDuration->i * 60) + ($totalDuration->h * 3600);
                    }
                }
            }    
            // Add the total break durations to the array
            $totalDurationsArray[] = $totalDurations;
            $breakDurationsArray[] = $totalBreakDurations;
            $actualDutyDurationsArray[] = $totalDurations - $totalBreakDurations;
        }
        // $breakDurationsArray now contains total break Durations for each work log entry without specific keys
        return view('superAdmin.reports.index', compact('workLogs', 'breakDurationsArray', 'totalDurationsArray', 'actualDutyDurationsArray'));
    }

}