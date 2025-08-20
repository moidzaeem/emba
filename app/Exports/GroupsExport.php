<?php

namespace App\Exports;

use App\Models\GroupAssignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GroupsExport implements FromCollection, WithHeadings
{
    protected $courseId;

    public function __construct($courseId)
    {
        $this->courseId = $courseId;
    }

    public function collection()
    {
        return GroupAssignment::with(['participant', 'group'])
            ->whereHas('group', function ($query) {
                $query->where('course_id', $this->courseId);
            })
            ->get()
            ->map(function ($assignment) {
                return [
                    'last_name' => $assignment->participant->last_name,
                    'first_name' => $assignment->participant->first_name,
                    'group_number' => $assignment->group->group_number,
                ];
            });
    }

    public function headings(): array
    {
        return ['Last Name', 'First Name', 'Group'];
    }
}
