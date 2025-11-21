<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\PurchaseRequest;
use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class PurchaseController extends Controller
{

    public function show($item_id){
        $user = Auth::user();
        $address = $user
            ->address()
            ->latest()
            ->first();
            
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
        return redirect()->route('purchase.show',['item_id'=>$returnId])->with('message','住所が更新されました');
    }


    public function store(PurchaseRequest $request){
        $validated = $request->validated();
        $validated['user_id']=Auth::id();
        $item = Item::findOrFail($validated['item_id']);
        Purchase::create($validated);
        return redirect()->route('index')->with('message','購入しました');
    }

    public function success(Request $request){
        $sessionId = $request->query('session_id');
        if (!$sessionId) {
            return redirect()->route('home')->with('message','決済セッションが見つかりませんでした');
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = StripeSession::retrieve($sessionId);
        $metadata = $session->metadata ?? null;
        $itemId = $metadata->item_id ?? null;
        $userId = $metadata->user_id ?? null;
        $addressId = $metadata->address_id ?? null;
        $subtotal = $session->amount_total ;

        if($itemId && $userId && $subtotal){
            Purchase::firstOrCreate([
                'item_id' => $itemId,
                'user_id' => $userId,],
                [
                'subtotal' => $subtotal,
                'payment_method' => 'カード支払い',
                'address_id' => $addressId,
            ]);
        }

        return redirect()->route('home')->with('message','購入が完了しました');
    }
}
