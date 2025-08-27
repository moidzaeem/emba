{{-- resources/views/courses/edit.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Course</h1>

        {{-- Display validation errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('courses.update', $course->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Course Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $course->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>



            <div class="mb-3">
                <label for="class" class="form-label">Class</label>
                <select class="form-select form-control @error('class') is-invalid @enderror" id="class" name="class"
                    required>
                    <option value="" disabled {{ old('class') ? '' : 'selected' }}>Select a class</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class->name }}" {{ $course->class == $class->name ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                    @endforeach

                </select>
                @error('class')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>



            <div class="mb-3">
                <label for="course_type" class="form-label">Course Type</label>
                <select class="form-select form-control @error('course_type') is-invalid @enderror" id="course_type"
                    name="course_type" required>
                    <option value="" disabled>Select a type</option>
                    <option value="Whole" {{ old('course_type', $course->course_type) == 'Whole' ? 'selected' : '' }}>Whole
                    </option>
                    <option value="Healthcare" {{ old('course_type', $course->course_type) == 'Healthcare' ? 'selected' : '' }}>Healthcare</option>
                    <option value="Finance" {{ old('course_type', $course->course_type) == 'Finance' ? 'selected' : '' }}>
                        Finance</option>
                </select>
                @error('course_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="group_size" class="form-label">Group Size (2 to 6)</label>
                <input type="number" class="form-control @error('group_size') is-invalid @enderror" id="group_size"
                    name="group_size" value="{{ old('group_size', $course->group_size) }}" min="2" max="7" required>
                @error('group_size')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Course</button>
        </form>
    </div>
@endsection