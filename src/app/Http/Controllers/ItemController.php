<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
<<<<<<< Updated upstream
use App\Models\Comment;
=======
use Illuminate\Support\Facades\Storage;
>>>>>>> Stashed changes

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

        $user = auth()->user();

        return view('item', compact('item','categories','liked','latestComment','user'))
            ->with('categories', $item->categories);
    }
}
