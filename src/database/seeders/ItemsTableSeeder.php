<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert(
            [[
                'user_id' => 1,
                'name' => '腕時計',
                'condition' => '良好',
                'brand' =>'Rolax',
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'price' => '15000',
                'avatar_path' => 'avatars/1/Armani+Mens+Clock.jpg',
            ],
            [
                'user_id' => 2,
                'name' => 'HDD',
                'condition' => '目立った傷や汚れ無し',
                'brand' =>'西芝',
                'description' => '高速で信頼性の高いハードディスク',
                'price' => '5000',
                'avatar_path' => 'avatars/1/HDD+Hard+Disk.jpg',
            ],
            [
                'user_id' => 3,
                'name' => '玉ねぎ3束',
                'condition' => 'やや汚れや傷あり',
                'brand' =>'なし',
                'description' => '新鮮な玉ねぎ3束のセット',
                'price' => '300',
                'avatar_path' => 'avatars/1/iLoveIMG+d.jpg',
            ],

            [
                'user_id' => 4,
                'name' => '革靴',
                'condition' => '状態が悪い',
                'brand' =>'',
                'description' => 'クラシックなデザインの革靴',
                'price' => '4000',
                'avatar_path' => 'avatars/1/Leather+Shoes+Product+Photo.jpg',
            ],
            [
                'user_id' => 5,
                'name' => 'ノートPC',
                'condition' => '良好',
                'brand' =>'',
                'description' => '高性能なノートパソコン',
                'price' => '45000',
                'avatar_path' => 'avatars/1/Living+Room+Laptop.jpg',
            ],
            [
                'user_id' => 6,
                'name' => 'マイク',
                'condition' => '目立った傷や汚れ無し',
                'brand' =>'なし',
                'description' => '高音質のレコーディング用マイク',
                'price' => '8000',
                'avatar_path' => 'avatars/1/Music+Mic+4632231.jpg',
            ],
            [
                'user_id' => 7,
                'name' => 'ショルダーバッグ',
                'condition' => 'やや汚れや傷あり',
                'brand' =>'',
                'description' => 'おしゃれなショルダーバッグ',
                'price' => '8000',
                'avatar_path' => 'avatars/1/Purse+fashion+pocket.jpg',
            ],
            [
                'user_id' => 8,
                'name' => 'タンブラー',
                'condition' => '状態が悪い',
                'brand' =>'なし',
                'description' => '使いやすいタンブラー',
                'price' => '500',
                'avatar_path' => 'avatars/1/Tumbler+souvenir.jpg',
            ],
            [
                'user_id' => 9,
                'name' => 'コーヒーミル',
                'condition' => '良好',
                'brand' =>'Starbacks',
                'description' => '手動のコーヒーミル',
                'price' => '4000',
                'avatar_path' => 'avatars/1/Waitress+with+Coffee+Grinder.jpg',
            ],
            [
                'user_id' => 10,
                'name' => 'メイクセット',
                'condition' => '目立った傷や汚れ無し',
                'brand' =>'',
                'description' => '便利なメイクアップセット',
                'price' => '2500',
                'avatar_path' => 'avatars/1/外出メイクアップセット.jpg',
            ],
        ]);
    }
}
