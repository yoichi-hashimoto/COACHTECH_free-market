<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{

    public function show($item_id)
    {
        $item = Item::with('categories')
            ->withCount('comments')
            ->findOrFail($item_id);

        $categories = $item->categories;
        
        $liked = false;
        if(auth()->check()){
            $liked = $item->followers()->whereKey(auth()->id())->exists();
        }
        
        $latestComment = $item->comments()
            ->with('user')
            ->latest()
            ->first();

        $user=auth()->user();
        $avatarUrl = $user && $user->avatar_path
        ? Storage::url($user->avatar_path)
        : asset('images/default-avatar.png');

        return view('item', compact('item','categories','liked','latestComment','avatarUrl'))
            ->with('categories', $item->categories);
    }
}
