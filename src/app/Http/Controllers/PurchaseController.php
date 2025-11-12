<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\User;
use App\Models\Item;
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
        if(is_null($address)){
            $address=(object)[
            'postal_code'=>'000-0000',
            'address'=>'住所登録がありません',
            'building'=>'-',
        ];}

        $item = Item::findOrFail($item_id);

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

}
