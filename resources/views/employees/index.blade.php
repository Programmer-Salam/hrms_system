@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center bg-white">
        <h4 class="mb-0"><i class="bi bi-people"></i> Employees</h4>
        <a href="{{ route('employees.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Employee
        </a>
    </div>

    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-4">
                <label>Filter by Department:</label>
                <select id="departmentFilter" class="form-select">
                    <option value="">All Departments</option>
                    @foreach($departments as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Skills</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="employeesTable">
                    @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->department->name ?? 'N/A' }}</td>
                        <td>
                            @foreach($employee->skills as $skill)
                            <span class="badge bg-secondary">{{ $skill->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Department Filter AJAX
    $('#departmentFilter').change(function() {
        const deptId = $(this).val();

        $.ajax({
            url: "{{ route('employees.index') }}",
            type: 'GET',
            data: {
                department_id: deptId,
                ajax: true
            },
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            beforeSend: function() {
                $('#employeesTable').html('<tr><td colspan="6" class="text-center">Loading...</td></tr>');
            },
            success: function(response) {
                $('#employeesTable').html(response.html);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                $('#employeesTable').html('<tr><td colspan="6" class="text-center text-danger">Error loading data</td></tr>');
            }
        });
    });
});
</script>
@endpush
