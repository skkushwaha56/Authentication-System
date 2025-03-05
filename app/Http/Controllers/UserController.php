<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register()
    {
        return view('registration');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('login.page')->with('success', 'User registered successfully');
    }

    public function get($id)
    {
        $data = User::find($id);
        
        if (!$data) {
            return response()->json(['message' => 'User not found'], 404);
        }
        
        return response()->json($data);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('edit-registration', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|unique:users,name,' . $id,
            'email' => 'required|string|email|unique:users,email,' . $id,
            'password' => 'nullable|string',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => isset($validated['password']) ? Hash::make($validated['password']) : $user->password,
        ]);

        return redirect()->route('registration')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('registration')->with('error', 'User not found');
        }

        $user->delete();

        return redirect()->route('registration')->with('success', 'User deleted successfully');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (User::attempt($credentials)){
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'invalid credenrials']);
    }
}
