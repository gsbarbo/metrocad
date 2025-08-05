<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDepartment extends Model
{
    // use SoftDeletes;

    protected $with = ['department'];

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
