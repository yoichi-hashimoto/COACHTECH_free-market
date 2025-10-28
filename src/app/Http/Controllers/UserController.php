<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        return view ('index');
    }

    public function showLoginForm()
    {
    return view('login');
    }

    public function login(LoginRequest $request){
        $credentials = $request->validated();

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/mypage');
        }

        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません',
        ]);
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(RegisterRequest $request){
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

    Auth::login($user);

    return redirect()->route('mypage')->with('message','登録が完了しました！');

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }

    public function mypage(){
        return view('mypage' , ['user' => Auth::user()]);
    }
}
