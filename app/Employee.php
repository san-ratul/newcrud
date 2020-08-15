<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name', 'email', 'phone_no', 'address', 'image'];

    public function salary()
    {
        return $this->hasOne(Salary::class,'employee_id');
    }
    
}
