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
        <a href="">出品した商品</a>
        <a href="">購入した商品</a>
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
{{--
        @if($item->is_sold)
        <span class="sold">売り切れ</span>

        @else
        <span class="on-sale">販売中</span>
        @endif
--}}

@empty
    <p>出品中の商品はありません</p>
@endforelse

@else

@forelse($items as $item)

    <div class="item__img--wrap">
        <a class="item__content" href="{{route('item', $item)}}">
            <img src="{{ $avatarPaths [$item->id] }}" alt="{{ $item->name }}" class="item__img">
            <p>{{ $item->name}}</p>
        </a>
    </div>
{{--
        @if($item->is_sold)
        <span class="sold">売り切れ</span>

        @else
        <span class="on-sale">販売中</span>
        @endif
--}}

@empty
    <p>出品中の商品はありません</p>
@endforelse
</div>

@endif
@endsection