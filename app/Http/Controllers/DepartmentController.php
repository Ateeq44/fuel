<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::orderBy('id', 'desc')->get();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'status' => 'required',
        ]);

        Department::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return redirect()->route('department.index')
                         ->with('success', 'Department added successfully');
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'status' => 'required',
        ]);

        $department = Department::findOrFail($id);

        $department->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return redirect()->route('department.index')
                         ->with('success', 'Department updated successfully');
    }

    public function destroy($id)
    {
        Department::findOrFail($id)->delete();
        return redirect()->route('department.index')
                         ->with('success', 'Department deleted successfully');
    }
}
