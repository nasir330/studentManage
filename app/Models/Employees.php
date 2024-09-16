<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    protected $guarded = [];

     //table relation with students
     public function toStudents() {
        return $this->hasMany(Student::class, 'assignedTo', 'userId');
    }

    //table relation with Department
    public function departments()
    {
        return $this->belongsTo(Department::class, 'department', 'id');
    }
    //table relation with Department
    public function employeeLogs()
    {
        return $this->hasOne(EmployeeLog::class, 'employeeId', 'userId');
    }
    //table relation with Projects
    public function projectManage(){
      return $this->hasOne(ProjectManage::class,'employeeId','userId');
  }
}
