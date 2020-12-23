<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login() {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
          $user = Auth::user();
          return response()->json(['success' => $user->createToken('MyApp')->accessToken], 200);
        }
        else {
          return response()->json(['error'=>'Unauthorized'], 401);
        }
    }

    public function logout() {
        if (Auth::check()) {
            Auth::user()->token()->revoke();
            return response()->json(['success' =>'logout_success'],200);
        }
        else {
            return response()->json(['error' =>'something went wrong'], 500);
        }
    }

    public function register() {
        $user = new User;
        $check_mail = User::where('email', request('email'))->exists();
        if ($check_mail) {
            return response()->json(['error' =>'email already exist'], 409);
        }
        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->save();
        return response()->json(['success' => $user->createToken('MyApp')->accessToken], 201);
    }
}
