<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index () {
        return view('auth.login');
    }

    public function login (Request $request) {

        $this->validate($request, [
            'email' => ['required'],
            'password'=>['required']
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return redirect('/login')->with('error', 'Email or Password is not valid !!');
        } else {
            Auth::login($user, false);
            return redirect('/dashboard');
        }
    }

    public function logout (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
