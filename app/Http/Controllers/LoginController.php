<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function create()
    {
        return view('Auth.login');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email:strict|max:100',
            'password' => 'required|min:8|max:100',
        ]);

        if (!$this->attemptLogin($validated, $request)) {
            return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
        }

        return redirect()->route('projects.index');
    }

    private function attemptLogin(array $validated, Request $request): bool
    {
        return Auth::attempt($validated, $request->boolean('remember'));
    }

    public function destroy()
    {
        Auth::logout();
        Session::invalidate();
        Session::regenerate(true);
        return redirect()->route('login.get');
    }
}
