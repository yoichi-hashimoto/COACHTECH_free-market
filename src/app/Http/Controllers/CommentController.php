<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Item;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(CommentRequest $request , Item $item)
    {
        $user = Auth::user();
        $validated = $request->validated(); 
        
        Comment::create
        ([
            'item_id' =>$item->id,
            'user_id' =>$user->id,
            'comment' =>$validated['comment']
        ]);

        return redirect()->back()->with('message', 'コメントを登録しました');  
    }

    public function show()
    {
        $user = Auth::user();
        $comments = Comment::orderBy('created_at','desc')->get();
        return view('item', compact('user','comments'));
    }
}
