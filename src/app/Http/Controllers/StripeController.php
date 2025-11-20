<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Purchase;

class StripeController extends Controller
{
    public function charge(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $item = Item::findOrFail($request->item_id);
        $user = auth()->user();

        $address = $user->address()->latest()->first();
        $addressId = optional($address)->id ?? null;

        $session = Session::create([
            'payment_method_types' => ['card'],
            'mode' => 'payment',
            'line_items' => [[
                'price_data' => [
                'currency' => 'jpy',
                'product_data' => [
                            'name' => $item->name,
                        ],
                'unit_amount' => $item->price,
                    ],
            'quantity' => 1,
            ]],
            'metadata' => [
                'item_id' => $item->id,
                'user_id' => $user->id,
                'address_id' => $addressId,
            ],
            'success_url' => route('purchase.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('purchase.cancel'),
        ]);

        return response()->json(['id' => $session->id]);
    }

}
