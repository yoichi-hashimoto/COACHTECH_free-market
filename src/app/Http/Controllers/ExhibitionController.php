<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ExhibitionRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;
use App\Models\Category;

class ExhibitionController extends Controller
{
    public function create(){
        $categories = Category::orderBy('id')->get(['id','name']);
        return view('sell',compact('categories'));
    }

    public function store(ExhibitionRequest $request){
        $validated = $request->validated(); 

        $item = new Item();
        $item->user_id     = Auth::id();
        $item->name        = $validated['name'];
        $item->condition   = $validated['condition'];
        $item->brand       = $validated['brand']?? null;
        $item->description = $validated['description'];
        $item->price       = $validated['price'];

        $item->save();

        if($request->hasFile('avatar')){
            $path=$request->file('avatar')
            ->store("avatars/{$item->id}", 'public');
            $item->avatar_path=$path;
            $item->save();
        }

        if(!empty($validated['categories'])){
            $item->categories()->sync($validated['categories']);
        }

    return redirect()->back()->with('message', '出品が完了しました');
    }

}
