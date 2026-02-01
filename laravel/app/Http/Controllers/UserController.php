<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create() {
        return view('users.create');
    }

    public function store(Request $request) {

        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:4'],
        ]);

        User::create($validated);

        return redirect()->route('login')->with('success', 'Юзер создался успешно.');
    }

    public function loginForm() {
        return view('users.login_form');
    }

    public function loginAuth(Request $request) {
        $validated = $request->validate([
            'email' => ['required', 'email',],
            'password' => ['required', 'min:4'],
        ]);

        if (Auth::attempt($validated)) {
            return redirect()->intended('/')->with('success', 'Авторизация пользователя прошла успешно');
        }

        return back()->withErrors([
            'email' => 'Неправильная электронная почта или пароль',
        ]);
    }
}
