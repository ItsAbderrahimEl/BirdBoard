<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function store()
    {
        $validated = request()->validate([
            'email' => 'required|email:strict|unique:users|max:100',
            'name' => 'required|string|max:100|min:3|regex:/^[a-zA-Z]+( [a-zA-Z]+)+$/',
            'password' => 'required|min:8|max:100|confirmed',
        ]);

        Auth::login(User::create($validated));

        return redirect()->route('projects.index');
    }

    public function create()
    {
        return view('Auth.register');
    }
}
