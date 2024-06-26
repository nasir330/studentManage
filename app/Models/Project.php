<?php

namespace App\Models;

use App\Models\Clients;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded =[];

    //Employee table relation
    public function clients()
    {
        return $this->belongsTo(Clients::class,'clientId', 'userId');
    }

     //table relation with employee
     public function employees() {
        return $this->belongsTo(Employees::class, 'clientId', 'userId');
    }

    public function projectManage()
    {
        return $this->hasOne(ProjectManage::class,'projectId', 'id');
    }
}