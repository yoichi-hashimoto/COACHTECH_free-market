@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/profile.css')}}">
@endsection

@section('content')
@php
  $user = $user ?? auth()->user();
  $avatarUrl = ($user && $user->avatar_path)
      ? \Illuminate\Support\Facades\Storage::url($user->avatar_path)
      : asset('images/default-avatar.png');
@endphp

    <form class="profile__input"  action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    <h2 class="profile__title">プロフィール設定</h2>
<div class="profile__items">
    <img src="{{ $avatarUrl }}" alt="プロフィール画像" class="profile__img">
    <label class="imgedit__button">
        画像を選択する
        <input type="file" name="avatar" accept="image/jpeg,image/png" hidden>
    </label>
    @error('avatar')
      <p class="error">{{ $message }}</p>
    @enderror
</div>
    <h3>ユーザー名
        <input type="text" name="name" value="{{ old('name', $user->name)}}">
    @error('name')
      <p class="error">{{ $message }}</p>
    @enderror
    </h3>
    <h3>郵便番号 
        <input type="text" name="postal_code" value="{{ old('postal_code', $user->postal_code)}}" placeholder="123-4567">
    @error('postal_code')
      <p class="error">{{ $message }}</p>
    @enderror
    </h3>
    <h3>住所
        <input type="text" name="address" value="{{ old('address' , $user->address)}}">
    @error('address')
      <p class="error">{{ $message }}</p>
    @enderror
    </h3>
    <h3>建物名
        <input type="text" name="building" value="{{ old('building', $user->building)}}">
    </h3>
    <button type="submit" class="update__button" >更新する</button>

</form>
@endsection
