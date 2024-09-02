<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function employees(){
        return $this->belongsTo(Employees::class,'userId');
    }
    //table relation with employee update fields
    public function employeeLog() {
        return $this->hasOne(EmployeeUpdateFields::class, 'logId', 'id');
    }
    //table relation with student update fields
    public function studentLog() {
        return $this->hasOne(StudentsUpdateFields::class, 'logId', 'id');
    }
}
