<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLog extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function project(){
        return $this->belongsTo(Project::class,'projectId','id');
    }

    public function employees(){
        return $this->belongsTo(Employees::class,'employeeId','userId');
    }
}