<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Item;
use App\Models\Address;
use App\Models\Purchase;
use Tests\TestCase;
use Illuminate\Validation\ValidationException;


class PurchaseTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_itemPurchase()
    {
        $this->withoutExceptionHandling();
        $user = \App\Models\User::factory()->create();
        $item = \App\Models\Item::factory()->create();
        $address = \App\Models\Address::factory()->for($user)->create();

        $this->actingAs($user);

        $formData = [
            'item_id' => $item->id,
            'address_id' => $address->id,
            'payment_method' => 'コンビニ払い',
            'subtotal' => $item->price,
        ];

        $response = $this->post('/purchase', $formData);
        $response->assertRedirect('/');

        $this->assertDatabaseHas('purchases', [
            'item_id' => $item->id,
            'user_id' => $user->id,
            'payment_method' => 'コンビニ払い',
            'subtotal' => $item->price,
        ]);
    }

    public function test_soldItemDisplayTab(){
        $user = \App\Models\User::factory()->create();
        $item = \App\Models\Item::factory()->create();
        Purchase::factory()->create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $this->actingAs($user);

        $index = $this->get('/');
        $index->assertStatus(200);
        $index->assertSee('SOLD');
    }

    public function test_boughtItemDisplayTab(){
        $user = \App\Models\User::factory()->create();
        $item = \App\Models\Item::factory()->create();

        Purchase::factory()->create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $this->actingAs($user);

        $mypage = $this->get('/mypage?page=buy');
        $mypage->assertStatus(200);
        $mypage->assertSee($item->name);
    }

    public function test_selectPayamentMethod(){
        $user = \App\Models\User::factory()->create();
        $item = \App\Models\Item::factory()->create();

        $this->actingAs($user);
    
        $response = $this->get('/purchase/'.$item->id);

        $response->assertStatus(200);
        $response->assertSee('payment_method');
        $response->assertSee('コンビニ払い');
        $response->assertSee('カード支払い');
    }

    public function test_changeAddressDisplay(){
        $user = \App\Models\User::factory()->create();
        $item = \App\Models\Item::factory()->create();

        $this->actingAs($user);

        $this->post('/purchase/address',[
            'return_item_id' => $item->id,
            'postal_code'=>'000-0000',
            'address'=>'テストアドレス',
            'building'=>'テスト建物',
        ])->assertRedirect('/purchase/'.$item->id);

        $purchase = $this->get('/purchase/'.$item->id);
        $purchase->assertStatus(200);
        $purchase->assertSee('000-0000');
        $purchase->assertSee('テストアドレス');
        $purchase->assertSee('テスト建物');
    }

    public function test_changedAddressStore(){
        $user = \App\Models\User::factory()->create();
        $item = \App\Models\Item::factory()->create();

        $this->actingAs($user);

        $this->post('/purchase/address',[
            'return_item_id' => $item->id,
            'postal_code'=>'000-0000',
            'address'=>'テストアドレス',
            'building'=>'テスト建物',
        ])->assertRedirect('/purchase/'.$item->id);

        $this->assertDatabaseHas('addresses', [
            'postal_code'=>'000-0000',
            'address'=>'テストアドレス',
            'building'=>'テスト建物',
        ]);
    }
}