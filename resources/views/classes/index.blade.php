@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Classes</h2>
        <a href="{{ route('classes.create') }}" class="btn btn-primary">
            <i class="mdi mdi-plus-circle-outline"></i> Add Class
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Class</th>
                        <th class="text-center" style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($classes as $class)
                        <tr>
                            <td>{{ $class->name }}</td>
                           
                            </td>
                            <td class="text-center">
                                <a href="{{ route('classes.edit', $class) }}" class="btn btn-sm btn-warning me-1" title="Edit">
                                    <i class="mdi mdi-pencil"></i>
                                </a>
                                <form action="{{ route('classes.destroy', $class) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this class?');">
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
                            <td colspan="5" class="text-center text-muted">No Class available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
