<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index(Request $request)
    {
        $query = Department::with('manager', 'employees');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->sort === 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $departments = $query->paginate(10)->appends($request->query());

        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        $managers = User::where('role', 'manager')->orWhere('role', 'admin')->orderBy('name')->get();

        return view('departments.create', compact('managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments',
            'code' => 'required|string|max:50|unique:departments',
            'manager_id' => 'nullable|exists:users,id',
            'description' => 'nullable|string',
        ]);

        Department::create($request->only(['name', 'code', 'manager_id', 'description']));

        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    public function edit(Department $department)
    {
        $managers = User::where('role', 'manager')->orWhere('role', 'admin')->orderBy('name')->get();

        return view('departments.edit', compact('department', 'managers'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,'.$department->id,
            'code' => 'required|string|max:50|unique:departments,code,'.$department->id,
            'manager_id' => 'nullable|exists:users,id',
            'description' => 'nullable|string',
        ]);

        $department->update($request->only(['name', 'code', 'manager_id', 'description']));

        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}
