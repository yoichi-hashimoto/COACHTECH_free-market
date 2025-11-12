<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        $this->call([
            CategoriesTableSeeder::class,
            ItemsTableSeeder::class,
        ]);

        \App\Models\Comment::factory(10)->create();
        \App\Models\Address::factory(10)->create();
        \App\Models\Like::factory(10)->create();
        \App\Models\Category_item::factory(10)->create();


    }
}
