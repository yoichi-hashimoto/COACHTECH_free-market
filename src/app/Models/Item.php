<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'avatar_path',
        'condition',
        'name',
        'brand',
        'description',
        'price',
    ];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class,'likes','item_id','user_id')->withTimestamps();
    }

    public function comments(){return $this->hasMany(Comment::class);}

    public function getAvatarUrlAttribute():string{
        return $this->avatar_path
        ? \Storage::url($this->avatar_path)
        :asset('images/default-avatar.png');
    }


}
