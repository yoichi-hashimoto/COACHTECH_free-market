@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/profile.css')}}">
@endsection

@section('content')

<form class="profile__input"  action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    <h2 class="profile__title">プロフィール設定</h2>
<div class="profile__items">
    <div class="profile__img--wrapper">
    @if($avatarUrl)
    <img src="{{ $avatarUrl }}" id="avatarPreview" alt="ユーザー画像が登録されていません" class="profile__img">
    @else
    <img id="avatarPreview" src="{{ asset('images/default-avatar.png')}}" alt="画像プレビュー">
    @endif
    </div>
    <label class="imgedit__button">
        画像を選択する
        <input id="avatar" type="file" name="avatar" accept="image/jpeg,image/png" hidden>
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
        <input type="text" name="postal_code" value="{{ old('postal_code', $address->postal_code ?? '')}}" placeholder="000-0000">
    @error('postal_code')
      <p class="error">{{ $message }}</p>
    @enderror
    </h3>
    <h3>住所
        <input type="text" name="address" value="{{ old('address' , $address->address ?? '')}}">
    @error('address')
      <p class="error">{{ $message }}</p>
    @enderror
    </h3>
    <h3>建物名
        <input type="text" name="building" value="{{ old('building', $address->building ?? '')}}">
    </h3>
    <button type="submit" class="update__button" >更新する</button>

</form>

<script>
  document.getElementById('avatar').addEventListener('change',function(event){
    const file = event.target.files[0];
        if (!file) return;
    const reader = new FileReader();
    reader.onload =function(event){
      const imgElement = document.getElementById('avatarPreview');
      imgElement.src = event.target.result;
      imgElement.style.display='block';
    };
    if(file){
      reader.readAsDataURL(file);
    };
  });
</script>

@endsection