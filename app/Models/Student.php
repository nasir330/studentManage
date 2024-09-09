<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  use HasFactory;
  protected $guarded = [];

  //table relation with country
  public function countryList()
  {
    return $this->belongsTo(CountryList::class, 'country', 'id');
  }
  //table relation with employee
  public function employees()
  {
    return $this->belongsTo(Employees::class, 'assignedTo', 'id');
  }
}
