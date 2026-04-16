<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index(Request $request)
    {
        $query = User::with('manager');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('email', 'like', '%'.$request->search.'%')
                    ->orWhere('role', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->sort === 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $users = $query->paginate(15)->appends($request->query());

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $departments = Department::orderBy('name')->get();
        $managers = User::where('role', 'manager')->orWhere('role', 'admin')->orderBy('name')->get();

        return view('users.create', compact('departments', 'managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,manager,driver,employee',
            'department' => 'nullable|string|max:255',
            'manager_id' => 'nullable|exists:users,id',
            'phone' => 'nullable|string|max:20',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'department' => $request->department,
            'manager_id' => $request->manager_id,
            'phone' => $request->phone,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $departments = Department::orderBy('name')->get();
        $managers = User::where('role', 'manager')->orWhere('role', 'admin')->orderBy('name')->get();

        return view('users.edit', compact('user', 'departments', 'managers'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'role' => 'required|in:admin,manager,driver,employee',
            'department' => 'nullable|string|max:255',
            'manager_id' => 'nullable|exists:users,id',
            'phone' => 'nullable|string|max:20',
        ]);

        $data = $request->only(['name', 'email', 'role', 'department', 'manager_id', 'phone']);

        if ($request->password) {
            $request->validate(['password' => 'string|min:8|confirmed']);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
