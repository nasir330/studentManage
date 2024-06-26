<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectManage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('clientId',Auth::user()->id)->get();
        
        return view('clients.projects.index',['projects'=>$projects]);

    }

    public function fetchProject($id){
        $project = Project::with(['projectManage.employees'])->find($id);

        // Check if the project was found
        if (!$project) {
            return response()->json(['message' => 'Project not found']);
        }

        
        // Check if there's a related ProjectManage and Employee for the project
        if (!$project->projectManage || !$project->projectManage->employees) {
            // return response()->json(['message' => 'Related ProjectManage or Employee not found']);
            $nickname = 'NA';
        } else{
            $nickname = $project->projectManage->employees->nickName;
        }

        // Return the desired details
        return response()->json([
            'status' => true,
            'projectId' => $project->id,
            'title' => $project->title, // Assuming 'title' is a field in the Project model
            'nickname' => $nickname // Assuming 'nickname' is a field in the Employees model
        ]);

    }
}