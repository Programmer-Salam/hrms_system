<?php
namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Skill;
use Illuminate\Http\Request;

class EmployeeController extends Controller {
  public function index(Request $request)
{
    $query = Employee::with('department', 'skills');

    if ($request->has('department_id') && $request->department_id != '') {
        $query->where('department_id', $request->department_id);
    }

    $employees = $query->get();
    $departments = Department::all();

    if ($request->ajax()) {
        $html = view('employees.partials.table', compact('employees'))->render();
        return response()->json(['html' => $html]);
    }

    return view('employees.index', compact('employees', 'departments'));
}

    public function create() {
        $departments = Department::all();
        $skills = Skill::all();
        return view('employees.create', compact('departments', 'skills'));
    }

    public function store(Request $request) {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees',
            'department_id' => 'required|exists:departments,id',
            'skills' => 'array',
            'skills.*' => 'exists:skills,id'
        ]);

        $employee = Employee::create($request->only(['first_name', 'last_name', 'email', 'department_id']));

        if ($request->skills) {
            $employee->skills()->sync($request->skills);
        }

        return redirect()->route('employees.index')->with('success', 'Employee created!');
    }

    public function show(Employee $employee) {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee) {
        $departments = Department::all();
        $skills = Skill::all();
        return view('employees.edit', compact('employee', 'departments', 'skills'));
    }

    public function update(Request $request, Employee $employee) {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'department_id' => 'required|exists:departments,id',
            'skills' => 'array',
            'skills.*' => 'exists:skills,id'
        ]);

        $employee->update($request->only(['first_name', 'last_name', 'email', 'department_id']));
        $employee->skills()->sync($request->skills ?? []);

        return redirect()->route('employees.index')->with('success', 'Employee updated!');
    }

    public function destroy(Employee $employee) {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted!');
    }

    public function checkEmail(Request $request) {
        $exists = Employee::where('email', $request->email)
            ->when($request->employee_id, function($q) use ($request) {
                return $q->where('id', '!=', $request->employee_id);
            })
            ->exists();

        return response()->json(['exists' => $exists]);
    }
}
