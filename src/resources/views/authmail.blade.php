<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
 
<h1>ようこそ<h1>

<p>以下の内容に間違えが無ければリンクをクリックして認証を完了させてください。</p>
<span>Eメールアドレス：{{ $email }}</span></br>
<span>お名前：{{ $name }}</span></br>

<a href="{{ $verifyUrl }}">認証リンク</a>
</body>
</html>