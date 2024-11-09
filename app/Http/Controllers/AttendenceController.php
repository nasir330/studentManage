<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendence;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class AttendenceController extends Controller
{
   public function create()
   {
      return view('superAdmin.attendence.create');
   }
   //store attendence
   public function storeAttendence(Request $request)
   {
      //return $request->all(); 

      // Store attendence paths
      $document_paths = [];
      if ($request->hasFile('docs')) {
         foreach ($request->file('docs') as $doc) {
            $doc_name = $doc->getClientOriginalName();
            $doc_storage = $doc->storeAs("public/uploads/attendence", $doc_name);
            $doc_path = 'storage/uploads/attendence/' . $doc_name;
            $document_paths[] = $doc_path;
         }
      }
      // Convert document paths array to JSON
      $documents_json = json_encode($document_paths);

      // store Students data
      $attendence = Attendence::create([
         'userId' => Auth::user()->id,
         'documents' => $documents_json,
      ]);

      // save log data
      $authEmployee = Auth::user()->employees;
      $logData = ActivityLog::create([
         'userId' => Auth::user()->id,
         'activity' => $authEmployee->firstName . ' ' . $authEmployee->lastName . ' has submitted attendence : ' . Auth::user()->id,
      ]);


      // Flash a success message and redirect back
      session()->flash('success', 'attendence submitted successfully..!!');
      return redirect()->back();
   }

   public function report()
   {
      $attendence = Attendence::orderBy('id', 'asc')->paginate('10');
      return view('superAdmin.attendence.index', ['attendence' => $attendence]);
   }

   //delete report
   public function deleteReport($id, Request $request)
   {
       // Find the attendance record
       $attendence = Attendence::find($id);
       if (!$attendence) {
           return redirect()->back()->with('error', 'Attendance record not found');
       }
   
       // Decode the documents array
       $documents = json_decode($attendence->documents, true);
   
       // Remove the specified document from the array
       $documentToDelete = $request->get('document');
       $documents = array_filter($documents, function($document) use ($documentToDelete) {
           return $document !== $documentToDelete;
       });
   
       // If there are documents left, update the JSON array in the database
       if (!empty($documents)) {
           $attendence->documents = json_encode(array_values($documents));
           $attendence->save();
       } else {
           // If no documents are left, delete the attendance record entirely
           $attendence->delete();
       }
   
       // Log the deletion activity
       $authEmployee = Auth::user()->employees;
       ActivityLog::create([
           'userId' => Auth::user()->id,
           'activity' => $authEmployee->firstName . ' ' . $authEmployee->lastName . ' has deleted a document from attendance id: ' . $id,
       ]);
   
       // Flash a success message
       session()->flash('delete', 'Document deleted successfully!');
       return redirect()->back();
   }
   
}
