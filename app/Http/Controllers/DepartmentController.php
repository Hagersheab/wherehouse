<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $departments = Department::where('name', 'like', "%$search%")
                ->get();
        }
        else {
            $departments = Department::all();
        }
        return view('department.index')->with('departments', $departments)->with('success', 'تم البحث بنجاح');

    }
    public function create()
    {
        return view('department.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $department = new Department();
        $department->name = $request->name;
        $department->description = $request->description;
        $department->save();
        return redirect()->route('department.index');
    }
    public function edit($id)
    {
        $department = Department::find($id);
        return view('department.edit', compact('department'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $department = Department::find($id);
        $department->name = $request->name;
        $department->description = $request->description;
        $department->save();
        return redirect()->route('department.index');
    }
    public function destroy($id)
    {
        $department = Department::find($id);
        $department->delete();
        return redirect()->route('department.index');
    }
}
