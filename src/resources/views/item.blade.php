@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/item.css')}}">
@endsection

@section('content')

@if($errors->any())
<div class="error__items">
    <ul class="error__list">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="grid">
<div class="item__img">
    

    <img src="{{ Storage::url($item->avatar_path ?? 'images/default-avatar.png') }}" alt="" class="item__photo">
</div>


<div>
    <h1>{{ $item->name}}</h1>
    <p>{{ $item->brand }}</p>
    <h2>{{ $item->price}}(税込)</h2>

<div class="star-comment__wrap">
<form action="{{route('item.like', $item)}}" method="POST" >
    @csrf
    <div class="like-star__wrap">
        <button type="submit" name="like" class="star__button">
        @if($liked)
            <img src="{{asset('images/afterいいねボタン.png')}}"  value="いいねボタン" class="like__star">
        @else
            <img src="{{asset('images/いいねボタン.png')}}"  value="いいねボタン" class="like__star">
        @endif
        </button>
            <p>
                {{$item->followers->count()}}
            </p>
    </div>
</form>

    <div class="comment__items">
        <button type="submit" name="commnent" class="comment__button">
        <img src="{{asset('images/コメントボタン.png')}}" alt="" value="コメント数" class="comment">
        </button>
            <p>
                {{ $item->comments_count }}
            </p>
    </div>
</div>

    <a href="{{ route('purchase')}}">
        <button class="purchase__button"> 購入手続きへ</button>
    </a>
    <h2>商品説明</h2>
    <p>{{ $item->description }}</p>

    <h2>商品の情報</h2>
    <div class="category__wrap">
    <h3 class="category__title">カテゴリー</h3>

@php
  $items = $items ?? collect();
@endphp

    @foreach($categories as $category)
        <li class="category__items">{{ $category->name }}</li>
    @endforeach
    <h3 class="condition__title">商品の状態</h3>
        <p class="condition">{{ $item->condition }}</p>
    </div>

    <div class="comment__wrap">
        <h2>コメント({{ $item->comments_count }})</h2>
        @if($latestComment)
        <div class="user__wrap">
            <img src="{{ $latestComment->user->avatarUrl }}" alt="" class="comment__user">
            <h3>{{ $latestComment->user->name }}</h3>
        </div>
            <p class="comment__box">{{ $latestComment->comment }}</p>
        @else
        <div class="user__wrap">
            <img src="" alt="no image" class="comment__user" value="no image">
            <h3>コメントユーザーなし</h3>
        </div>
            <p class="comment__box">コメントはまだありません</p>
        @endif
        <div class="comment__input">
            <h3>商品へのコメント</h3>
    <form action="{{ route('comment.store', ['item' => $item->id] )}}" method="POST">
        @csrf
            <textarea class="comment__text" type="textarea" name="comment">{{ old('comment')}}</textarea>
        </div>
            <button type="submit" class="comment__submit">コメントを送信する</button>
    </form>
    </div>
</div>
</div>
@endsection