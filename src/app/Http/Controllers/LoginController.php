<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('login');
    }


    public function login(LoginRequest $request)
    {
        $validated = $request->validated([
        ]);

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $request->login,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors([
            'login' => 'Email/Username hoặc mật khẩu không đúng!',
        ]);    
    }


    public function store(Request $request):RedirectResponse
    {
        $validated = $request->validated();

        return redirect()->route('login-form')->with('success', 'Bạn đã đăng xuất!');
    }
}
