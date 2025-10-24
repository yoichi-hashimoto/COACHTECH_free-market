@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/detail.css')}}">
@endsection

@section('content')
<div class="grid">
<div class="product__img">
    <img src="images/Armani+Mens+Clock.jpg" alt="" class="product__photo">
</div>

<div>
    <h1>商品名がここに入る</h1>
    <p>ブランド名</p>
    <h2>¥47,000 (税込)</h2>
    <div>
        <img src="" alt="" value="いいねボタン">
        <img src="" alt="" value="コメント数">
    </div>
    <button class="purchace__button"> 購入手続きへ</button>

    <h2>商品説明</h2>
    <p>カラー：グレー
        新品　商品の状態は良好です。　傷もありません。購入後、即発送いたします。</p>

    <h2>商品の情報</h2>
    <div class="category__wrap">
    <h3 class="category__title">カテゴリー</h3>
        <li class="category__items">洋服</li>
        <li class="category__items">洋服</li>
        <li class="category__items">洋服</li>
        <li class="category__items">その他</li>
    <h3 class="condition__title">商品の状態</h3>
        <p class="condition">良好</p>
    </div>

    <div class="comment__wrap">
        <h2>コメント(1)</h2>
        <div class="user__wrap">
            <img src="/images/Leather+Shoes+Product+Photo.jpg" alt="" class="comment__user">
            <h3>admin</h3>
        </div>
        <div>
            <p class="comment__box">こちらにコメントが入ります</p>
        </div>
        <div class="comment__input">
            <h3>商品へのコメント</h3>
            <input class="comment__text" type="textarea">
        </div>
        <button class="comment__button">コメントを送信する</button>
    </div>
</div>
</div>
@endsection