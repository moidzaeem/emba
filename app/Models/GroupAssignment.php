<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupAssignment extends Model
{
     protected $fillable = [
        'group_id',
            'participant_id',

        // other fillable fields...
    ];


    // Define participant relationship
    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    // Optionally, define group relationship if you want
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
