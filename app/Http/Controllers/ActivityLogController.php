<?php

namespace App\Http\Controllers;
use App\Models\ActivityLog;
use App\Models\EmployeeUpdateFields;
use App\Models\StudentsUpdateFields;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
  
    public function index(){
        $activityLog = ActivityLog::orderBy('id','asc')->paginate('20');
        return view('superAdmin.reports.index',['activityLog' => $activityLog]);
            
    }
    public function viewEmployeeLog($id){
        $activityLogDetails = EmployeeUpdateFields::where(['logId'=>$id])->get();
        //return $activityLogDetails;
        return view('superAdmin.reports.viewEmployeeLog',['activityLogDetails' => $activityLogDetails]);

    }
    public function viewStudentLog($id){
        $activityLogDetails = StudentsUpdateFields::where(['logId'=>$id])->get();
        //return $activityLogDetails;
        return view('superAdmin.reports.viewStudentLog',['activityLogDetails' => $activityLogDetails]);

    }

}