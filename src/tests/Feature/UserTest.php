<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\Address;
use App\Models\Category;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_userDisplay()
    {
        $user = User::factory()->create([
            'avatar_path'=> 'avatar/test.png',
            'name'=>'テスト一郎',
        ]);
        $sellItem = Item::factory()->create([
            'user_id'=>$user->id,
            'name'=>'出品商品'
        ]);

        $buyItem = Item::factory()->create([
            'name'=>'購入した商品'
        ]);

        Purchase::factory()->create([
            'user_id' => $user->id,
            'item_id' => $buyItem->id,
        ]);

        $this->actingAs($user);

        $mypageSell = $this->get('/mypage?page=buy');
        $mypageSell->assertStatus(200)
                    ->assertSee('avatar/test.png')
                    ->assertSee('テスト一郎')
                    ->assertSee('購入した商品');
        $mypageBuy = $this->get('/mypage?page=sell');
        $mypageBuy->assertStatus(200)
                    ->assertSee('出品商品');
        }

    public function test_userFirstSeetingRemain(){
            $user = User::factory()->create([
                'avatar_path'=>'avatar/test.png',
                'name'=>'テスト二郎',
            ]);

            $address = Address::factory()->for($user)->create([
                'postal_code'=>'123-4567',
                'address'=>'福島県福島市長者村555',
                'building'=>'金持ハイツ',
            ]);

            $this->actingAs($user);

            $profile = $this->get('/mypage/profile');
            $profile->assertStatus(200)
                    ->assertSee('avatar/test.png')
                    ->assertSee('テスト二郎')
                    ->assertSee('123-4567')
                    ->assertSee('福島県福島市長者村555')
                    ->assertSee('金持ハイツ');
    }

    public function test_sellItemStore(){
        $this->withoutExceptionHandling();

        Storage::fake('public');

        $user = User::factory()->create();
        $category = Category::factory()->create([
            'name'=>'インテリア',
        ]);
        
        $this->actingAs($user);

        $itemData = [
            'name' => 'あのツボ',
            'categories' => [$category->id],
            'condition' => '良好',
            'brand' => 'ジオン公国',
            'description' => 'このツボは良いものだ。キシリア様へ献上してください。',
            'price' => 32500,
        ];

        $response = $this->post('/sell',$itemData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('items',[
            'name' => 'あのツボ',
            'condition' => '良好',
            'brand' => 'ジオン公国',
            'description' => 'このツボは良いものだ。キシリア様へ献上してください。',
            'price' => 32500,
            'user_id' => $user->id,
        ]);

        $item = Item::where('name','あのツボ')->firstOrFail();

        $this->assertDatabaseHas('category_item',[
            'item_id'=> $item->id,
            'category_id'=> $category->id]);
    }
}
