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

        $item = new item();
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

        if(!empty($validated['category'])){
            $item->categories()->sync($validated['category']);
        }

    return redirect()->back()->with('message', '製品情報を登録しました');
    }

    public function update(ExhibitionRequest $request, item $item){

        abort_if($item->user_id !== Auth::id(), 403);

        $validated = $request -> validated();

        if($request->hasFile('avatar')){
            if($item->avatar_path && Storage::disk('public')->exists($item->avatar_path)){
                Storage::disk('public')->delete($item->avatar_path);
            }
            $path=$request->file('avatar')->store("avatars/$item->id","public");
            $item->avatar_path=$path;
        }
            $item->fill([
            'name'        => $validated['name'],
            'condition'   => $validated['condition'],
            'brand'       => $validated['brand'] ?? null,
            'detail'      => $validated['detail'],
            'price'       => $validated['price'],
            ])->save();

            if(!empty($validated['category'])){
                $item->categories()->sync($validated['category']);
            }

        return back()->with('message', '商品情報を登録しました');
    }
    }
