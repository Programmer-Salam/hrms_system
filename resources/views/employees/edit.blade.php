@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <h4 class="mb-0"><i class="bi bi-person-gear"></i> Edit Employee</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('employees.update', $employee) }}" method="POST">
            @csrf @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>First Name *</label>
                    <input type="text" name="first_name" class="form-control" value="{{ $employee->first_name }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Last Name *</label>
                    <input type="text" name="last_name" class="form-control" value="{{ $employee->last_name }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email *</label>
                    <input type="email" name="email" id="email" class="form-control"
                           value="{{ $employee->email }}" data-employee-id="{{ $employee->id }}" required>
                    <div class="form-text text-danger" id="emailError" style="display:none;">
                        Email already taken!
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Department *</label>
                    <select name="department_id" class="form-select" required>
                        <option value="">Select Department</option>
                        @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ $employee->department_id == $dept->id ? 'selected' : '' }}>
                            {{ $dept->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 mb-4">
                    <label>Skills</label>
                    <div id="skillsContainer">
                        @php $employeeSkills = $employee->skills->pluck('id')->toArray(); @endphp

                        @if(count($employeeSkills) > 0)
                            @foreach($employeeSkills as $index => $skillId)
                            <div class="skill-row input-group mb-2">
                                <select name="skills[]" class="form-select">
                                    <option value="">Select Skill</option>
                                    @foreach($skills as $skill)
                                    <option value="{{ $skill->id }}" {{ $skillId == $skill->id ? 'selected' : '' }}>
                                        {{ $skill->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @if($index > 0)
                                <button type="button" class="btn btn-danger remove-skill">
                                    <i class="bi bi-trash"></i>
                                </button>
                                @endif
                            </div>
                            @endforeach
                        @else
                            <div class="skill-row input-group mb-2">
                                <select name="skills[]" class="form-select">
                                    <option value="">Select Skill</option>
                                    @foreach($skills as $skill)
                                    <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-danger remove-skill" style="display:none;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                    <button type="button" id="addSkill" class="btn btn-secondary btn-sm mt-2">
                        <i class="bi bi-plus-circle"></i> Add Another Skill
                    </button>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Employee</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let skillCount = {{ count($employeeSkills) > 0 ? count($employeeSkills) : 1 }};

    $('#addSkill').click(function() {
        skillCount++;
        const newRow = `
            <div class="skill-row input-group mb-2" id="skillRow${skillCount}">
                <select name="skills[]" class="form-select">
                    <option value="">Select Skill</option>
                    @foreach($skills as $skill)
                    <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-danger remove-skill">
                    <i class="bi bi-trash"></i>
                </button>
            </div>`;
        $('#skillsContainer').append(newRow);
        $('.remove-skill').show();
    });

    $(document).on('click', '.remove-skill', function() {
        if ($('.skill-row').length > 1) {
            $(this).closest('.skill-row').remove();
        }
        if ($('.skill-row').length === 1) {
            $('.remove-skill').hide();
        }
    });

    // Email check for edit
    $('#email').on('blur', function() {
        const email = $(this).val();
        const employeeId = $(this).data('employee-id');

        if (email) {
            $.ajax({
                url: "{{ route('check.email') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    email: email,
                    employee_id: employeeId
                },
                success: function(response) {
                    if (response.exists) {
                        $('#emailError').show();
                        $('#email').addClass('is-invalid');
                    } else {
                        $('#emailError').hide();
                        $('#email').removeClass('is-invalid');
                    }
                }
            });
        }
    });
});
</script>
@endpush
