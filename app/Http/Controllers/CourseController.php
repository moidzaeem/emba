<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CustomClass;
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
        $classes = CustomClass::where('is_deleted', false)->get();
        return view('courses.create', compact('classes'));
    }

    public function store(Request $request)
    {
        Course::create($request->validate([
            'name' => 'required',
            'class' => 'required',
            'course_type' => 'required|in:Whole,Healthcare,Finance',
            'group_size' => 'required|integer|min:2|max:7'
        ]));

        return redirect()->route('courses.index');
    }

    public function edit(Course $course)
    {
         $classes = CustomClass::where('is_deleted', false)->get();
        return view('courses.edit', compact('course', 'classes'));
    }

    public function update(Request $request, Course $course)
    {
        $course->update($request->validate([
            'name' => 'required',
            'class' => 'required',
            'course_type' => 'required|in:Whole,Healthcare,Finance',
            'group_size' => 'required|integer|min:2|max:7'
        ]));

        return redirect()->route('courses.index');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return back();
    }
}

