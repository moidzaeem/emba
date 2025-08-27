<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CustomClass;
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

        // 🔁 Delete old groups and their assignments
        $oldGroups = Group::where('course_id', $course->id)->get();
        foreach ($oldGroups as $group) {
            GroupAssignment::where('group_id', $group->id)->delete();
            $group->delete();
        }

        // 🎯 Filter participants
        $participants = Participant::where('class', $course->class);
        if(count($participants->get())<=0){
            return back()->with(['status' => 'No participants found for this course.']);
        }
        if ($course->course_type !== 'Whole') {
            $participants = $participants->where('focus', $course->course_type);
        }

        $participants = $participants->get()->shuffle();

        $groupSize = $course->group_size;
        $numGroups = ceil($participants->count() / $groupSize);

        // 🆕 Create new groups
        $groups = collect(range(1, $numGroups))->map(function ($i) use ($course) {
            return Group::create([
                'course_id' => $course->id,
                'group_number' => $i
            ]);
        });

        // ➕ Assign participants to groups
        foreach ($participants as $i => $participant) {
            $group = $groups[$i % $numGroups];
            GroupAssignment::create([
                'group_id' => $group->id,
                'participant_id' => $participant->id
            ]);
        }

        return redirect()->route('groups.history')->with('success', 'Groups regenerated!');
    }


public function history(Request $request)
{
    $query = Course::with(['groups.assignments.participant']);

    $classes = CustomClass::where('is_deleted', false)->get();

    // Optional class filter
    if ($request->filled('class')) {
        $query->where('class', $request->input('class'));
    }

    // Fetch courses
    $courses = $query->get();

    // Sort by latest group creation time (desc)
    $courses = $courses->sortByDesc(function ($course) {
        return optional($course->groups->max('created_at'));
    });

    return view('groups.history', compact('courses','classes'));
}



    public function export($courseId)
    {
        return Excel::download(new GroupsExport($courseId), 'groups.xlsx');
    }
}

