<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $users = User::where('name', 'LIKE', "%{$query}%")->get();
        } else {
            $users = User::all();
        }

        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'userType' => 'required',
            'password' => 'required',
        ]);

        User::create($request->all());
        return redirect()->route('user.index')->with('success', '');
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'userType' => 'required',
        ]);
        $user->update($request->all());
        return redirect()->route('user.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')
            ->with('success', 'User deleted successfully.');
    }
}
