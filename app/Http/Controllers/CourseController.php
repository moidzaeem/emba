<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->get();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        Course::create($request->validate([
            'name' => 'required',
            'class' => 'required|integer|min:1|max:2',
            'course_type' => 'required|in:Whole,Healthcare,Finance',
            'group_size' => 'required|integer|min:2|max:6'
        ]));

        return redirect()->route('courses.index');
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $course->update($request->validate([
            'name' => 'required',
            'class' => 'required|integer|min:1|max:2',
            'course_type' => 'required|in:Whole,Healthcare,Finance',
            'group_size' => 'required|integer|min:2|max:6'
        ]));

        return redirect()->route('courses.index');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return back();
    }
}

