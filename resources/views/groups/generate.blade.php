@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">
            <i class="mdi mdi-account-multiple-plus"></i> Generate Groups
        </h2>
    </div>

    {{-- Flash Message (Optional) --}}
    @if(session('status'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('status') }}
        </div>
    @endif

    {{-- Form Card --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('groups.generate') }}">
                @csrf

                <div class="mb-3">
                    <label for="course_id" class="form-label">
                        <i class="mdi mdi-book-open-page-variant"></i> Select Course
                    </label>
                    <select name="course_id" id="course_id" class="form-select form-control @error('course_id') is-invalid @enderror" required>
                        <option value="" disabled selected>-- Choose a course --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">
                                {{ $course->name }} (Class {{ $course->class }})
                            </option>
                        @endforeach
                    </select>
                    @error('course_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="mdi mdi-cogs"></i> Generate Groups
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
