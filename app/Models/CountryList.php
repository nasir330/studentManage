<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryList extends Model
{
    use HasFactory;

     //table relation with student
     public function designations()
     {
         return $this->hasOne(Designation::class, 'departmentId', 'id');
     }
}
