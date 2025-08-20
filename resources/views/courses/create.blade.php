{{-- resources/views/courses/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Course</h1>

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

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Course Name</label>
            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="name"
                name="name"
                value="{{ old('name') }}"
                required
            >
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="class" class="form-label">Class (1 or 2)</label>
            <input
                type="number"
                class="form-control @error('class') is-invalid @enderror"
                id="class"
                name="class"
                value="{{ old('class') }}"
                min="1"
                max="2"
                required
            >
            @error('class')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="course_type" class="form-label">Course Type</label>
            <select
                class="form-select @error('course_type') is-invalid @enderror"
                id="course_type"
                name="course_type"
                required
            >
                <option value="" disabled {{ old('course_type') ? '' : 'selected' }}>Select a type</option>
                <option value="Whole" {{ old('course_type') == 'Whole' ? 'selected' : '' }}>Whole</option>
                <option value="Healthcare" {{ old('course_type') == 'Healthcare' ? 'selected' : '' }}>Healthcare</option>
                <option value="Finance" {{ old('course_type') == 'Finance' ? 'selected' : '' }}>Finance</option>
            </select>
            @error('course_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="group_size" class="form-label">Group Size (2 to 6)</label>
            <input
                type="number"
                class="form-control @error('group_size') is-invalid @enderror"
                id="group_size"
                name="group_size"
                value="{{ old('group_size') }}"
                min="2"
                max="6"
                required
            >
            @error('group_size')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create Course</button>
    </form>
</div>
@endsection
