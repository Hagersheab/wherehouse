<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $users = User::where('name', 'like', "%$search%")
                ->get();
        }
        else {
            $users = User::all();
        }
        return view('user.index')->with('users', $users)->with('success', 'تم البحث بنجاح');

    }
    public function edit($id)
    {
        $user = User::find($id);
        $departments = Department::all();
        return view('user.edit', compact('user', 'departments'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'department_id' => 'required',
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->department_id = $request->department_id;
        $user->save();
        return redirect()->route('user.index');
    }
}
