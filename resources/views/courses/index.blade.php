@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Courses</h2>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">
            <i class="mdi mdi-plus-circle-outline"></i> Add Course
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Type</th>
                        <th>Group Size</th>
                        <th class="text-center" style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($courses as $course)
                        <tr>
                            <td>{{ $course->name }}</td>
                            <td>
                                <span class="badge bg-primary">Class {{ $course->class }}</span>
                            </td>
                            <td>
                                <span class="badge bg-info text-dark">{{ $course->course_type }}</span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $course->group_size }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-warning me-1" title="Edit">
                                    <i class="mdi mdi-pencil"></i>
                                </a>
                                <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this course?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No courses available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
