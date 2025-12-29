<?php
namespace App\Http\Controllers;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller {
  public function index()
{
    $departments = Department::withCount('employees')->get();
    return view('departments.index', compact('departments'));
}

    public function create() {
        return view('departments.create');
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|unique:departments']);
        Department::create($request->all());
        return redirect()->route('departments.index')->with('success', 'Department created!');
    }
}
