@extends('layouts.simple')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/auth.css')}}">
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
    </div>
@endif

<div class="auth__items">
    <h3>登録いただいたメールアドレスに認証メールを送りました</br>
    メール認証を完了してください。</h3>
<form action="{{ route('auth.check') }}" method="POST">
    @csrf
    <button class="auth__button" >認証はこちらから</button>
</form>
<form method="POST" action="{{ route('auth.resend') }}">
    @csrf
    <div class="auth__resend">
        <button type="submit" class="auth__resend" >認証メールを再送する</button>
    </div>
</form>
</div>
@endsection