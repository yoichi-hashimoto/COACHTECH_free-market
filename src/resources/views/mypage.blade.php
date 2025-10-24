@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/mypage.css')}}">
@endsection

@section('content')
<div class="users__box">
        <img src="/images/iLoveIMG+d.jpg" alt="" class="users__img">
        <h2 class="users__name">ユーザー名</h2>
    <form action="">
        <button href="" type="submit" class="edit__button">プロフィールを編集</button>
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