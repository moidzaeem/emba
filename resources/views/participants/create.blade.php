@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Participant</h2>
    <form method="POST" action="{{ route('participants.store') }}">
        @csrf
        @include('participants.form')
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
