@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Group History</h2>

    <!-- Filter by Class -->
    <form method="GET" action="{{ route('groups.history') }}" class="mb-4 row g-2 align-items-center">
        <div class="col-auto">
            <label for="class" class="col-form-label">Filter by Class:</label>
        </div>
        <div class="col-auto">
            <select name="class" id="class" class="form-select form-control" onchange="this.form.submit()">
                <option value="">-- All Classes --</option>
                @foreach($classes as $class)
                    <option value="{{ $class->name }}" {{ request('class') == $class->name ? 'selected' : '' }}>
                        {{ $class->name  }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    @forelse($courses as $course)
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">{{ $course->name }} (Class {{ $course->class }})</h5>
                    <small class="text-muted">
                        Last generated: 
                        {{ optional($course->groups->max('created_at'))->format('M d, Y H:i') ?? 'N/A' }}
                    </small>
                </div>
                <a href="{{ route('groups.export', $course->id) }}" class="btn btn-sm btn-outline-primary">
                    Download Excel
                </a>
            </div>
            <div class="card-body">
                @forelse($course->groups->sortBy('group_number') as $group)
                    <div class="mb-3">
                        <h6 class="text-primary">Group {{ $group->group_number }}</h6>
                        <ul class="list-group list-group-flush">
                            @foreach($group->assignments as $assignment)
                                <li class="list-group-item">
                                    {{ $assignment->participant->first_name }} {{ $assignment->participant->last_name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @empty
                    <p class="text-muted">No groups generated for this course yet.</p>
                @endforelse
            </div>
        </div>
    @empty
        <p class="text-muted">No group history found.</p>
    @endforelse
</div>
@endsection
