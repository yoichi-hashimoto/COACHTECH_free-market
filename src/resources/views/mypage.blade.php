@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/mypage.css')}}">
@endsection

@section('content')
@php
  $user = $user ?? auth()->user();

  $avatarUrl = ($user && $user->avatar_path)
      ? Storage::url($user->avatar_path): asset('images/default-avatar.png');
@endphp

<div class="users__box">
    <img src="{{ $avatarUrl }}" alt="ユーザー画像" class="users__img">
        <h2 class="users__name">{{ $user->name}}</h2>
    <form action="">
        <a href="{{ route('profile.edit')}}" type="submit" class="edit__button">プロフィールを編集</a>
    </form>
</div>
    <div class="select__tab">
        <a href="">出品した商品</a>
        <a href="">購入した商品</a>
    </div>

        <div class="products__container">
        <div class="products__box">
        <div class="products__photo">商品画像
            <img src="" alt="">
        </div>
        <p class="products__name">商品名</p>
        </div>

                <div class="products__box">
        <div class="products__photo">商品画像
            <img src="" alt="">
        </div>
        <p class="products__name">商品名</p>
        </div>
                <div class="products__box">
        <div class="products__photo">商品画像
            <img src="" alt="">
        </div>
        <p class="products__name">商品名</p>
        </div>


                <div class="products__box">
        <div class="products__photo">商品画像
            <img src="" alt="">
        </div>
        <p class="products__name">商品名</p>
        </div>


                <div class="products__box">
        <div class="products__photo">商品画像
            <img src="" alt="">
        </div>
        <p class="products__name">商品名</p>
        </div>


                <div class="products__box">
        <div class="products__photo">商品画像
            <img src="" alt="">
        </div>
        <p class="products__name">商品名</p>
        </div>


@endsection