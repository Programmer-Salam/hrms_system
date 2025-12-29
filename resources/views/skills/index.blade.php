@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white">
                <h4 class="mb-0"><i class="bi bi-tags"></i> Skills</h4>
            </div>
            <div class="card-body">
             <table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Employees Count</th>
        </tr>
    </thead>
    <tbody>
        @foreach($skills as $skill)
        <tr>
            <td>{{ $skill->id }}</td>
            <td>{{ $skill->name }}</td>
            <td>
                <span class="badge bg-primary">{{ $skill->employees_count ?? 0 }}</span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white">
                <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Add New Skill</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('skills.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Skill Name *</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Skill</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
