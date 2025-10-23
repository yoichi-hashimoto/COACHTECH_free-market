<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtech_free-market</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <header class="header">
        <img class="header__img" src="{{ asset('images/logo.svg')}}">
        <form action="">
            <div class="header__items">
            <input class="header__input" type="text" name="name" placeholder="なにをお探しですか？" >
        <nav class="links">
            <li href="" class="header__login">ログイン</li>
            <li href="" class="header__mypage">マイページ</li>
            <li href="" class="header__sell">出品</li>
        </nav>
            </div>
        </form>
    </header>
    @yeild('content')
</body>
</html>