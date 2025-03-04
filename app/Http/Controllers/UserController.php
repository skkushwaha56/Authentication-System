<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function register(){
        return view('registration');
    }

    public function store(Request $request){

        $validate = $request->validate([
            'name' =>  'required | string',
            'email' => 'required | string',
            'password' => 'required|string'
            
        ]);

        User::created([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);
    }

    public function get($id){
        $data = User::find($id);
    }

    public function update(request $request, $id){
        $request->validate([
            'name' => 'required|string|unique:users,name,' . $id,
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = user::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
    }

    public function destroy($id){
        $user = User::find($id);

        $user->delete();
    }
}
