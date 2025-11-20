<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< Updated upstream
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
=======
use App\Http\Requests\AddressRequest;
use App\Http\Requests\PurchaseRequest;
use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
>>>>>>> Stashed changes

class PurchaseController extends Controller
{
    public function purchase(){
        return view ('purchase');
    }

    public function address(){
        $user = Auth::user();
        $address = $user
            ->address()
            ->latest()
            ->first();
<<<<<<< Updated upstream
=======
        $item = Item::findOrFail($item_id);
>>>>>>> Stashed changes

        return view ('purchase',compact('address'));
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
