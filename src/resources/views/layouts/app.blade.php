<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtech_free-market</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @yield('css')
</head>
<body>
    <header class="header">
        @auth
        <img class="header__img" src="{{ asset('images/logo.svg')}}">
        <form action="">
            @csrf
            <input class="header__input" type="text" name="name" placeholder="なにをお探しですか？" >
        <nav class="links">
            <li href="" class="header__login">ログアウト</li>
            <li href="" class="header__mypage">マイページ</li>
            <li href="" class="header__sell">出品</li>
        </nav>
        </form>
        @endauth

        @guest
        <img class="header__img" src="{{ asset('images/logo.svg')}}">
        <form action="">
            @csrf
            <input class="header__input" type="text" name="name" placeholder="なにをお探しですか？" >
        <nav class="links">
            <li href="" class="header__login">ログイン</li>
            <li href="" class="header__mypage">マイページ</li>
            <li href="" class="header__sell">出品</li>
        </nav>
        </form>
        @endguest
    </header>
    <main>
    @yield('content')
    </main> 
</body>
</html>