<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Arr;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $address = $user->address()->first();
        $avatarUrl = $user->avatar_path
        ? Storage::url($user->avatar_path)
        : asset('images/default-avatar.png');
        return view('profile', ['user'=>$user,'address'=>$address,'avatarUrl'=>$avatarUrl,]);
    }

    public function update(ProfileRequest $request)
    {
    $user = Auth::user();

    $validated = $request->validated();

    if ($request->hasFile('avatar')) {
        $path = $request->file('avatar')->store("avatars/{$user->id}", 'public');
        $user->avatar_path = $path;
        }
    $user->name = $validated['name'];
    $user->save();
    $address = Arr::only($validated,['postal_code','address','building']);
    $user->address()->updateOrCreate(['user_id' => $user->id],$address);
    return redirect()->route('mypage')->with('message', 'プロフィールを更新しました');
    }


}
