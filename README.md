#アプリケーション名

フリマアプリ

---

#概要

このアプリケーションは、Laravel を使用して構築したフリマアプリです。  
ユーザー登録、商品出品、購入、コメント、いいね機能など、基本的なフリマ機能を実装しています。

---

#環境構築

##Docker ビルド

    -git clone git@github.com:yoichi-hashimoto/COACHTECH_free-market.git
    -docker compose up -d --build

##laravel 環境構築

    -docker-compose exec php bash

    -composer install

    -cp .env.example .env、環境変数を変更

    ※artisanはsrc配下です。
    -php artisan key generate
    -php artisan migrate
    -php artisa db:seed

---

#開発環境

-トップ画面 http://localhost/

-ユーザー登録画面 http://localhost/register/

-phpMyAdmin http://localhost:8080/

-Mailhog http://localhost:8025/

---

#使用技術

    -PHP 8.4.12
    -laravel 8.83.29
    -Composer 2.8.12
    -MySQL 8.0.26
    -Docker 4.43.2
    -nginx 1.21.1
      -HTML/CSS/JavaScript
      -その他:Fortify,Stripe

---

#主な機能

    -ユーザー登録（Fortify）　/　ログイン（メール認証対応、MailControllerを使用）
    -プロフィール編集（画像アップロード）
    -商品一覧表示（おすすめ、マイリスト（いいねボタンを押した商品））
    -商品詳細表示
    -商品出品機能
    -コメント投稿機能
    -いいね機能
    -商品購入機能（カード払い時にStripe 連携）
    -カテゴリ検索・キーワード検索（部分一致）
    -マイページ画面（出品・購入履歴）

---

#ER 図
![ER図](docs/er.png)
