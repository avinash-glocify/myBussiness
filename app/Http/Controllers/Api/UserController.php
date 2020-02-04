<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Http\Requests\RegisterRequest;
use Auth;

class UserController extends Controller
{
    public function Login(Request $request)
    {
      $credentials = $request->only('email', 'password');

      if (! $token = auth('api')->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
      }
      return response(['token' => $token]);
    }

    public function Register(RegisterRequest $request)
    {
        $user = User::create([
          'name'     => $request->name,
          'email'    => $request->email,
          'password' => Hash::make($request->password)
        ]);
        if($user) {
          return response(['user' => $user]);
        }
        return response(['errror' => 'Something went wrong']);
    }

    public function fetchUsers()
    {
       $users = User::all();
       return response(['users' => $users]);
    }
}
