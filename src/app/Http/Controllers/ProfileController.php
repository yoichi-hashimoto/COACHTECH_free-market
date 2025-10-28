<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

public function update(ProfileRequest $request)
{
    $user = Auth::user();

    $validated = $request->validated();

    if ($request->hasFile('avatar')) {
        $path = $request->file('avatar')->store("avatars/{$user->id}", 'public');
        $user->avatar_path = $path;
    }

    $user->name        = $validated['name'];
    $user->postal_code = $validated['postal_code'];
    $user->address     = $validated['address'];
    $user->building    = $validated['building'];
    $user->save();

    return back()->with('message', 'プロフィールを更新しました');
    }
}
