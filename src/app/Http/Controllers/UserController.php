<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Item;
use App\Models\Like;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request){
        $keyword = $request->input('keyword'); 
        $base = Item::query()
        ->with(['categories','user'])
        ->when(Auth::check(), function($query)
        {
            return $query->where('user_id','!=', Auth::id());
        })
        ->latest();
        $items = (clone $base)
            ->when(!empty ($keyword), function($query) use ($keyword)
           { 
            return $query->where('name','like',"%{$keyword}%");
            })
            ->get();
        return view ('index',['items'=>$items,'keyword'=>$keyword,'tab'=>'all']);
    }

    public function mylist(Request $request)
    {
        $keyword=trim($request->input('keyword',''));
        $base=Item::query()
        ->when(Auth::check(),function($query)
        {
            return $query->where('user_id','!=',Auth::id());
        });
        $items = Auth::user()
        ->likes()
        ->when(!empty ($keyword),function ($query) use ($keyword)
            {
            return $query-> where('name','like',"%{$keyword}%");
            })
        ->with(['categories','user'])
        ->latest()
        ->get();


        return view('index',[
            'items' => $items,
            'keyword'=> $request ->input('keyword'),
            'tab' =>'mylist',
        ]);
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

    public function mypage(Request $request)
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');

        $avatarUrl = $user->avatar_path
        ? Storage::url($user->avatar_path)
        : asset('images/default-avatar.png');

        $base = Item::query()
        ->where('user_id',$user->id)
        ->with(['categories'])
        ->latest();

        $items = $base->get();

        $avatarPaths = [];
        foreach ($items as $it) {
        $avatarPaths[$it->id] = $it->avatar_path
        ? Storage::url($it->avatar_path)
        : asset('images/default-item.png');}
        
        $keyword = $request->input('keyword');

        $results = (clone $base)
        ->where('name', 'like',"%{$keyword}%")
        ->get();

    return view('mypage', compact('user', 'avatarUrl', 'items', 'avatarPaths','results','keyword'));
}


}