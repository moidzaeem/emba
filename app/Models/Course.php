<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'class', 'course_type', 'group_size'];
    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}
