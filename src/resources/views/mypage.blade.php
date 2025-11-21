@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/mypage.css')}}">
@endsection

@section('content')

<div class="users__box">
    <img src="{{ $avatarUrl }}" alt="ユーザー画像" class="users__img">
        <h2 class="users__name">{{ $user->name}}</h2>
        <a href="{{ route('profile.edit')}}" type="submit" class="edit__button">プロフィールを編集</a>
</div>
    <div class="select__tab">
        <a href="{{route('mypage',['page'=>'sell'])}}">出品した商品</a>
        <a href="{{route('mypage',['page'=>'buy'])}}">購入した商品</a>
    </div>

<div class="items__container">

@if(filled($keyword))

@forelse($results as $result)

    <div class="item__img--wrap">
        <a class="item__content" href="{{route('item', $result)}}">
            <img src="{{ $result->avatar_path ? Storage::url($result->avatar_path) :asset('images/default-avatar.png') }}" alt="{{ $result->name }}" class="item__img">
            <p>{{ $result->name}}</p>
        </a>
    </div>

@empty
    <p>該当する商品はありません</p>
@endforelse

@else

@forelse($items as $item)

    <div class="item__img--wrap">
        <div class="item__content">
            <img src="{{ Storage::url($item->avatar_path) }}" alt="{{ $item->name }}" class="item__img">
            <p>{{ $item->name}}</p>
            @if($item->purchases_count > 0)
            <span class="sold">SOLD</span>
            @endif
        </div>
    </div>

@empty
    <p>該当する商品はありません</p>
@endforelse
</div>

@endif
@endsection