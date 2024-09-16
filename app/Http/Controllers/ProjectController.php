<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\ProjectManage;

class ProjectController extends Controller
{
    public function index()
    {
        $employeeList = User::where('userType',3)->get();
        $projects = Project::all();
        return view('superAdmin.projects.index',['employeeList'=>$employeeList, 'projects'=>$projects]);
    }
    //create project
    public function store(Request $request)
    {   
        //return $request->all();     
        $projectId = mt_rand(1000, 9999);
        $clients = Project::create([
            'projectId'=> $projectId,
            'clientId'=> $request->councilorId,
            'title'=> $request->title,
        ]);
        session()->flash('success', 'Project created successfully');
        return redirect()->back();
    }
    public function viewProject($id)
    {  
        $projects = Project::find($id);        
        $employee = $projects->employees;    
        $studentList = $employee->toStudents;      
        return view('superAdmin.projects.view',['projects'=>$projects,'employee'=>$employee,'studentList'=>$studentList]);
    }
    //assing employee form
    public function assignEmployee()
    {
        $employees = User::where('userType',3)->get();
        $projects = Project::all();
        $activeProject = ProjectManage::all();
        return view('superAdmin.projects.edit',['employees'=>$employees, 'projects'=>$projects, 'activeProject'=>$activeProject]); 
    }
    //employee assign into project
    public function storeAssignEmployee(Request $request)
    {
        
        ProjectManage::create([
            'projectId' => $request->projectId,
            'employeeId' => $request->employeeId,
        ]);
        session()->flash('success', 'Employee assigned into project');
        return redirect()->back();
    }

    

    public function deleteProject($id){
        $project = Project::find($id);
        if($project == null){
            $message = ' Project not Found.';
            session()->flash('error',$message);
            
            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        }
        $project->delete();

        $message = 'Project Deleted Successfully.';
        session()->flash('success', $message);

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }
}