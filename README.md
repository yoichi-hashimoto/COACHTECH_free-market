#アプリケーション名
フリマアプリ

#概要
このアプリケーションは、Laravelを使用して構築したフリマアプリです。
ユーザー登録、商品出品、購入、コメント、いいね機能など、基本的なフリマ機能を実装しています。

#環境構築
  -Dockerビルド
    -git clone ~~
    -docker compose up -d --build
  -laravle環境構築
    -docker-compose exec php bash
    -composer install
    -cp .env.example .env、環境変数を変更
    -php artisan key generate
    -php artisan migrate
    -php artisa db:seed
  -開発環境
    -お問い合わせ画面：
    -ユーザー登録：
    -phpMyAdmin：
##使用技術
    -PHP
    -laravel
    -MySQL
    -Docker
    -nginx
    -HTML/CSS/JavaScript
    -その他:Fortify,Stripe
##主な機能
  -ユーザー登録　/　ログイン（メール認証対応）
  -プロフィール編集（画像アップロード）
  -商品一覧表示（おすすめ、マイリスト）
  -商品詳細表示
  -商品出品機能
  -コメント投稿機能
  -いいね機能
  -商品購入機能（Stripe 連携）
  -カテゴリ検索・キーワード検索（部分一致）
  -マイページ画面（出品・購入履歴）
##ER図
  src/public/images/er.png
##URL
