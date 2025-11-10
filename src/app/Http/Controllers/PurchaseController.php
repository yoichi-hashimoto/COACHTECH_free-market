<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

        return view ('purchase',compact('address'));
    }
}
