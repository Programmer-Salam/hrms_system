<?php
namespace App\Http\Controllers;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller {
public function index()
{
    $skills = Skill::withCount('employees')->get();
    return view('skills.index', compact('skills'));
}
    public function create() {
        return view('skills.create');
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|unique:skills']);
        Skill::create($request->all());
        return redirect()->route('skills.index')->with('success', 'Skill created!');
    }
}
