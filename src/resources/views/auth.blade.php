@extends('layouts.simple')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/auth.css')}}">
@endsection

@section('content')
<form>
<div class="auth__items">
    <h3>登録いただいたメールアドレスに認証メールを送りました</br>
    メール認証を完了してください。</h3>

    <button class="auth__button" >認証はこちらから</button>

    <div class="auth__resend">
        <a href=>認証メールを再送する</a>
    </div>
</div>
</form>
    </div>
@endsection