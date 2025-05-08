<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }



    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8',
    ]);

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))) {
        return redirect()->intended(route('employees.index'));
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}



    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
