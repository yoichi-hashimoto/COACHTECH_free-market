<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\PurchaseRequest;
use App\Models\Address;
use App\Models\User;
use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class PurchaseController extends Controller
{

    public function show($item_id){
        $user = Auth::user();
        $address = $user
            ->address()
            ->latest()
            ->first();
        $item = Item::findOrFail($item_id);
        // if(is_null($address)){
        //     return redirect()
        //     ->route('address.edit',['item_id'=>$item->id])
        //     ->with('message','住所登録をしてください');
        // }

        return view ('purchase',compact('address','item'));
    }

    public function edit(Request $request){
        $address = Auth::user()->address()->first();
        $itemId = $request->query('item_id');
        return view ('address',compact('address','itemId'));
    }

    public function update(AddressRequest $request){
        $validated = $request->validated();
        $user = Auth::user();
        $address = Arr::only($validated,['postal_code','address','building']);
        $user->address()->updateOrCreate(
        ['user_id' => $user->id],
        $address
        );
        $returnId = $request->input('return_item_id');
        return redirect()->route('purchase',['item_id'=>$returnId])->with('message','住所が更新されました');
    }


    public function store(PurchaseRequest $request){
        $validated = $request->validated();
        $validated['user_id']=Auth::id();
        $item = Item::findOrFail($validated['item_id']);
        Purchase::create($validated);
        return redirect()->route('index')->with('message','購入しました');
    }
}
