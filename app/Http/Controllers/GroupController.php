<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Group;
use App\Models\GroupAssignment;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Exports\GroupsExport;
use Maatwebsite\Excel\Facades\Excel;

class GroupController extends Controller
{
    public function showGenerateForm()
    {
        $courses = Course::all();
        return view('groups.generate', compact('courses'));
    }

    public function generate(Request $request)
    {
        $course = Course::findOrFail($request->course_id);

        // Filter participants
        $participants = Participant::where('class', $course->class);
        if ($course->course_type !== 'Whole') {
            $participants = $participants->where('focus', $course->course_type);
        }

        $participants = $participants->get()->shuffle();

        $groupSize = $course->group_size;
        $numGroups = ceil($participants->count() / $groupSize);

        // Create groups
        $groups = collect(range(1, $numGroups))->map(function ($i) use ($course) {
            return Group::create([
                'course_id' => $course->id,
                'group_number' => $i
            ]);
        });

        // Assign participants to groups
        foreach ($participants as $i => $participant) {
            $group = $groups[$i % $numGroups];
            GroupAssignment::create([
                'group_id' => $group->id,
                'participant_id' => $participant->id
            ]);
        }

        return redirect()->route('groups.history')->with('success', 'Groups generated!');
    }

    public function history()
    {
        $courses = Course::with('groups.assignments.participant')->get();
        return view('groups.history', compact('courses'));
    }

    public function export($courseId)
    {
        return Excel::download(new GroupsExport($courseId), 'groups.xlsx');
    }
}

