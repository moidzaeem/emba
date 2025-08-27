{{-- resources/views/courses/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Class</h1>

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

    <form action="{{ route('classes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Class Name</label>
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

        <button type="submit" class="btn btn-primary">Create Class</button>
    </form>
</div>
@endsection
