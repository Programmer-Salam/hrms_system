@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0"><i class="bi bi-person-badge"></i> Employee Details</h4>
        <div>
            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <th width="40%">Employee ID</th>
                        <td>{{ $employee->id }}</td>
                    </tr>
                    <tr>
                        <th>First Name</th>
                        <td>{{ $employee->first_name }}</td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td>{{ $employee->last_name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $employee->email }}</td>
                    </tr>
                    <tr>
                        <th>Department</th>
                        <td>{{ $employee->department->name ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>

            <div class="col-md-6">
                <h5>Skills</h5>
                @if($employee->skills->count() > 0)
                <div class="d-flex flex-wrap gap-2">
                    @foreach($employee->skills as $skill)
                    <span class="badge bg-primary p-2">{{ $skill->name }}</span>
                    @endforeach
                </div>
                @else
                <p class="text-muted">No skills assigned</p>
                @endif

                <hr>

                <h5>Additional Info</h5>
                <p><strong>Created:</strong> {{ $employee->created_at->format('M d, Y') }}</p>
                <p><strong>Last Updated:</strong> {{ $employee->updated_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
