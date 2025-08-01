<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $dates = ['created_at', 'dob','updated_at', 'join_date'];
    protected $fillable = [
    'user_id', 'first_name', 'last_name', 'sex', 'dob', 'join_date',
    'desg', 'department_id', 'salary', 'photo', 'remaining_leave',
    'cuti_melahirkan', 'cuti_menikah', 'cuti_berduka'
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function department() {
        // return $this->hasOne('App\Department');
        return $this->belongsTo('App\Department');
    }

    public function attendance() {
        return $this->hasMany('App\Attendance');
    }

    public function leave() {
        return $this->hasMany('App\Leave');
    }

    public function expense() {
        return $this->hasMany('App\Expense');
    }

    //     // app/Models/Employee.php
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

}
