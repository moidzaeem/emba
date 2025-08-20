@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Group History</h2>

    @foreach($courses as $course)
        <h4>{{ $course->name }} (Class {{ $course->class }})</h4>
        <a href="{{ route('groups.export', $course->id) }}" class="btn btn-sm btn-outline-primary mb-2">Download Excel</a>

        @foreach($course->groups as $group)
            <strong>Group {{ $group->group_number }}</strong>
            <ul>
                @foreach($group->assignments as $assignment)
                    <li>{{ $assignment->participant->first_name }} {{ $assignment->participant->last_name }}</li>
                @endforeach
            </ul>
        @endforeach
        <hr>
    @endforeach
</div>
@endsection
