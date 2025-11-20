<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illminate\Support\Facades\Auth;
use App\Models\Item; 

class LikeStar extends Component
{
    public function render()
    {
        return view('livewire.like-star');
    }
}
