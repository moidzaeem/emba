@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Participants</h2>
            <a href="{{ route('participants.create') }}" class="btn btn-primary">
                <i class="mdi mdi-account-plus"></i> Add Participant
            </a>
        </div>

        {{-- Import Excel Form --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form action="{{ route('participants.import') }}" method="POST" enctype="multipart/form-data"
                    class="row g-3 align-items-center">
                    @csrf
                    <div class="col-md-6">
                        <input type="file" name="file" class="form-control" required>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success">
                            <i class="mdi mdi-file-import"></i> Import Excel
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Participants Table --}}
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Focus</th>
                            <th>Gender</th>
                            <th>Class</th>
                            <th class="text-center" style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($participants as $p)
                            <tr>
                                <td>{{ $p->first_name }} {{ $p->last_name }}</td>
                                <td>
                                    <span class="badge bg-info text-white">{{ $p->focus }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary text-white">{{ $p->gender }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-light border">{{ $p->class }}</span>
                                </td>
                                <td class="text-center">
                                    {{-- <a href="{{ route('participants.edit', $p) }}" class="btn btn-sm btn-warning me-1">
                                        <i class="mdi mdi-pencil"></i>
                                    </a> --}}
                                    <form action="{{ route('participants.destroy', $p) }}" method="POST" class="d-inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this participant?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No participants found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection