@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/sell.css')}}">
@endsection

@section('content')
<form class="sell__input">
    <h2 class="sell__title">商品の出品</h2>
<div class="sell__img">
    <h3>商品画像
    <div class="sell__img--area">
    <button href="" class="sell__img--button">画像を選択する</button>
    </h3>
    <div>
</div>
<section class="section">
  <h2 class="section__title">商品の詳細</h2>

  <div class="field">
    <h3 class="field__label">カテゴリー</h3>

    <div class="chip-group" role="radiogroup" aria-label="カテゴリー">
      <input type="checkbox" name="category" id="cat-fashion"  value="ファッション" class="chip-input">
      <label for="cat-fashion" class="chip">ファッション</label>

      <input type="checkbox" name="category" id="cat-appliance" value="家電" class="chip-input">
      <label for="cat-appliance" class="chip">家電</label>

      <input type="checkbox" name="category" id="cat-interior" value="インテリア" class="chip-input">
      <label for="cat-interior" class="chip">インテリア</label>

      <input type="checkbox" name="category" id="cat-ladies" value="レディース" class="chip-input">
      <label for="cat-ladies" class="chip">レディース</label>

      <input type="checkbox" name="category" id="cat-mens" value="メンズ" class="chip-input">
      <label for="cat-mens" class="chip">メンズ</label>

      <input type="checkbox" name="category" id="cat-cosme" value="コスメ" class="chip-input">
      <label for="cat-cosme" class="chip">コスメ</label>

      <input type="checkbox" name="category" id="cat-book" value="本" class="chip-input">
      <label for="cat-book" class="chip">本</label>

      <input type="checkbox" name="category" id="cat-game" value="ゲーム" class="chip-input">
      <label for="cat-game" class="chip">ゲーム</label>

      <input type="checkbox" name="category" id="cat-sports" value="スポーツ" class="chip-input">
      <label for="cat-sports" class="chip">スポーツ</label>

      <input type="checkbox" name="category" id="cat-kitchen" value="キッチン" class="chip-input">
      <label for="cat-kitchen" class="chip">キッチン</label>

      <input type="checkbox" name="category" id="cat-handmade" value="ハンドメイド" class="chip-input">
      <label for="cat-handmade" class="chip">ハンドメイド</label>

      <input type="checkbox" name="category" id="cat-accessory" value="アクセサリー" class="chip-input">
      <label for="cat-accessory" class="chip">アクセサリー</label>

      <input type="checkbox" name="category" id="cat-toy" value="おもちゃ" class="chip-input">
      <label for="cat-toy" class="chip">おもちゃ</label>

      <input type="checkbox" name="category" id="cat-baby" value="ベビー・キッズ" class="chip-input">
      <label for="cat-baby" class="chip">ベビー・キッズ</label>
    </div>
  </div>
</section>

    <h3 class="condition">商品の状態</h3>
        <select class="condition__select" name="" id="">
            <option value="" disable hidden>選択してください</option>
            <option>良好</option>
            <option>目立った傷や汚れ無し</option>
            <option value="">やや汚れや傷あり</option>
            <option value="">状態が悪い</option>
        </select>

<section>
    <div class="section__item--wrap">
    <h2 class="section__title">商品名と説明</h2>
    <h3>商品名</h3>
        <input class="section__item" type="text">
    <h3>ブランド名</h3>
        <input class="section__item" type="text">
    <h3>商品の説明</h3>
        <input class="section__item--detail" type="text">
    <h3>販売価格</h3>
        <input class="section__item" type="number">
    </div>
</section>

    <button class="sell__button" >出品する</button>
</form>
@endsection