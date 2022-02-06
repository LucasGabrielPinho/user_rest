<?php

namespace App\Http\Controllers;

use App\Models\User, Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $req){
        $this->validate($req, [
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        $email = $req->input('email');
        $password = Hash::make($req->input('password'));

        $user = User::create([
            'email'     => $email,
            'password'  => $password
        ]);

        if($user){
            return $req;
        }else{
            return $req;
        }

    }

    public function findAll() {
        $user = User::all();
        return response()->json($user);
    }

    public function find($id) {
        $user = User::find($id);
        return response()->json($user);
    }

    public function update(Request $req){
        $this->validate($req, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::find($req->id);
        $user->email =  $req->email;
        $user->password =  Hash::make($req->password);
        $user->save();

        return response()->json(['User sucessfully updated!']);
    }

    public function delete($id) {
        $user = User::find($id);
        $user->delete();
        return response()->json('User sucessfully deleted!');
    }

}
