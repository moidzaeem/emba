<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['course_id', 'group_number'];

    public function assignments()
    {
        return $this->hasMany(GroupAssignment::class);
    }
}
