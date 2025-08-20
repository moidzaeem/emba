<?php

namespace App\Imports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParticipantsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       return new Participant([
            'first_name' => $row['first_name'],
            'last_name'  => $row['last_name'],
            'focus'      => $row['focus'],
            'gender'     => $row['gender'],
            'class'      => $row['class'],
        ]);
    }
}
