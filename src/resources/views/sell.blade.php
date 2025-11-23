@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/sell.css')}}">
@endsection

@section('content')
<form action="{{ route('sell.store')}}" method="POST" class="sell__input" enctype="multipart/form-data">
    @csrf
<h2 class="sell__title">商品の出品</h2>
<div class="sell__img">
    <h3>商品画像</h3>
@php
    $item = $item ?? null;
    $avatarUrl=($item && $item->avatar_path)
        ? \Illuminate\Support\Facades\Storage::url($item->avatar_path)
        :asset('image/default-avatar.png');
@endphp
    <img src="{{ $avatarUrl }}" alt="商品画像" id='preview' class="sell__img--preview">

    <label class="sell__img--button">
        <input type="file" id="avatar" name="avatar" accept="image/jpeg,image/png"  hidden>画像を選択する
    </label>
</div>
    @error('avatar')
        <p>{{ $message}}</p>
    @enderror
<section class="section">
  <h2 class="section__title">商品の詳細</h2>

  <div class="field">
    <h3 class="field__label">カテゴリー</h3>
    <div class="chip-group">
  @php
    $oldCats = old('category', []);
  @endphp
  
  @foreach($categories as $cat)
    <input type="checkbox"
           name="category[]"
           id="cat-{{ $cat->id }}"
           value="{{ $cat->id }}"
           class="chip-input"
           {{ in_array($cat, $oldCats, true) ? 'checked' : '' }}>
    <label for="cat-{{ $cat->id }}" class="chip">{{ $cat->name }}</label>
  @endforeach
    </div>
  </div>
    @error('category')
    <p>{{ $message }}</p>
    @enderror
    @error('category.*')
    <p>{{ $message }}</p>
    @enderror
</section>

    <h3 class="condition">商品の状態</h3>
        <select class="condition__select" name="condition" id="condition">
            <option value="" disabled {{ old('condition') ? '':'selected'}} hidden>選択してください</option>
            <option value="良好" {{ old('condition')==='良好' ? '' : 'selected'}}>良好</option>
            <option value="目立った傷や汚れ無し" {{ old('condition')==='目立った傷や汚れ無し' ? '' : 'selected'}}>目立った傷や汚れ無し</option>
            <option value="やや汚れや傷あり" {{ old('condition')==='やや汚れや傷あり' ? '' : 'selected'}}>やや汚れや傷あり</option>
            <option value="状態が悪い" {{ old('condition')==='状態が悪い' ? '' : 'selected'}}>状態が悪い</option>
        </select>
    @error('condition')
        <p>{{ $message}}</p>
    @enderror
<section>
    <div class="section__item--wrap">
    <h2 class="section__title">商品名と説明</h2>
    <h3>商品名</h3>
        <input class="section__item" type="text" name="name" value="{{old('name')}}">
    @error('name')
        <p>{{ $message}}</p>
    @enderror

    <h3>ブランド名</h3>
        <input class="section__item" type="text" name="brand" value="{{old('brand')}}">
    @error('brand')
        <p>{{ $message}}</p>
    @enderror
    <h3>商品の説明</h3>
        <textarea class="section__item--detail" type="text" name="description">{{old('description')}}</textarea>
    @error('description')
        <p>{{ $message}}</p>
    @enderror
    <h3>販売価格</h3>
        <input class="section__item" type="text" name="price" value="{{old('price')}}">
    @error('price')
        <p>{{ $message}}</p>
    @enderror
    </div>
</section>

    <button type="submit" class="sell__button" >出品する</button>
</form>


<script>
document.getElementById('avatar').addEventListener('change', function(e) {
  const file = e.target.files[0];          // 選ばれたファイルを取得
  if (!file) return;                       // ファイルが無ければ終了

  const reader = new FileReader();         // FileReaderというブラウザの機能を使う
  reader.onload = function(event) {        // 読み込みが完了したら…
    document.getElementById('preview').src = event.target.result; // <img>のsrcを書き換え
  };
  reader.readAsDataURL(file);              // 画像データを読み込む
});
</script>

@endsection