<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Item;
use App\Models\Like;
use App\Models\Purchase;
use App\Mail\AuthMail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request){
        $keyword = $request->input('keyword'); 
        $base = Item::withCount('purchases')
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
        $items=Item::withCount('purchases')
        ->whereHas('followers',function($query){
        $query->where('user_id',Auth::id());
        })
        ->when(!empty ($keyword),function ($query) use ($keyword)
            {
            return $query-> where('name','like',"%{$keyword}%");
            })
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
            $user = Auth::user();
            if (is_null($user->email_verified_at)){
                $message = 'メール認証が完了していません。認証メールをご確認ください。';
                return redirect()->route('auth')->withErrors($message);
            }
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
        $token = Str::random(64);
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'email_token' => $token,
        ]);

        Auth::login($user);
        Mail::to($user->email)->send(
        new AuthMail($user, $token)
        );
        return redirect()->route('auth');
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

        $page = $request->query('page','sell');
        if($page === 'buy'){
            $purchaces = Purchase::with('item')
            ->where('user_id',Auth::id())->get();
            $items= $purchaces->pluck('item')->filter();
        }else{
            $items = Item::query()
            ->where('user_id',Auth::id())->get();
        }

        // $purchased = Purchase::query()
        // ->where('user_id',$user->id)
        // ->latest();
        // $bought = $purchased->get();

        $avatarPaths = [];
        foreach ($items as $it) {
        $avatarPaths[$it->id] = $it->avatar_path
        ? Storage::url($it->avatar_path)
        : asset('images/default-item.png');}
        
        $keyword = $request->input('keyword');

        $results = Item::query()
        // ->with(['categories','user'])
        // ->when(Auth::check(), function($query)
        // {
        //     return $query->where('user_id','!=', Auth::id());
        // })
        ->when($keyword !== '', function($query)use($keyword){
        $query->where('name', 'like',"%{$keyword}%");})
        ->get();

    return view('mypage', compact('user', 'avatarUrl', 'items', 'avatarPaths','results','keyword','page'));
    }

}