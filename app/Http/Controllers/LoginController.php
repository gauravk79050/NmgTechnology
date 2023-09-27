<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
   public function index(Request $req) {
    $email = $req->input('email');
    $password = $req->input('password');
    $req->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt(['email' => $email, 'password' => $password])) {
        $user = Auth::user();
        if ($user) {
            $req->session()->put('userId',$user->id );
            $req->session()->put('role',$user->role );
            return redirect()->route('user');
        } 
    } else {
        return redirect()->route('login')->with('error', 'Invalid credentials. Please try again.');
    }
   }
}
