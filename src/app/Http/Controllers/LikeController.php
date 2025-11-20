<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class LikeController extends Controller
{
    public function index()
    {

        return view('item');
    }

    public function toggle(Item $item)
    {
        $userId =auth()->id();
        $item -> followers()->toggle($userId);
        return back();
    }
}

