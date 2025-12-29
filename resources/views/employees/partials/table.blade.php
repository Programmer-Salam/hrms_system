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

@if($employees->isEmpty())
<tr>
    <td colspan="6" class="text-center">No employees found.</td>
</tr>
@endif
