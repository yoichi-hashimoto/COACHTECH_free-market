<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class ItemListTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_allItems()
    {
        $items = \App\Models\Item::factory()->count(3)->create();

        $response = $this->get('/');
        $response->assertStatus(200);
        foreach($items as $item){
            $response->assertSee($item->name);
        }
    }

    public function test_soldItemsLabel()
    {
        $soldItems = \App\Models\Purchase::factory()->create();

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('SOLD');
    }

    public function test_mysellItemsNotDisplay()
    {
        $user = \App\Models\User::factory()->create();
        $ownItems = Item::factory()->for($user)->create([
            'name' => 'MY_OWN_ITEMS_12345',
        ]);
        $otherItems = Item::factory()->create([
            'name' => 'OTHER_ITEMS_67890',
        ]);

        $this->actingAs($user);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertDontSee($ownItems->name);
        $response->assertSee($otherItems->name);
    }

    public function test_mylistItemsDisplay()
    {
        $user = \App\Models\User::factory()->create();
        $followedItems = \App\Models\Item::factory()->create();
        $followedItems->followers()->attach($user->id);

        $this->actingAs($user);

        $response = $this->get('/mylist');
        $response->assertStatus(200);
        $response->assertSee($followedItems->name);
    }

    public function test_mylistSoldItemsLabel()
    {
        $user = \App\Models\User::factory()->create();
        $soldFollowedItems = \App\Models\Item::factory()->create();
        $soldFollowedItems->followers()->attach($user->id);
        \App\Models\Purchase::factory()->create([
            'item_id' => $soldFollowedItems->id,
        ]);

        $this->actingAs($user);

        $response = $this->get('/mylist');
        $response->assertStatus(200);
        $response->assertSee('SOLD');
    }

    public function test_mylistFailureNotAuthenticated()
    {
        $response = $this->get('/mylist');
        $response->assertRedirect('/login');
    }
    
    public function test_searchItems()
    {
        $item1 = \App\Models\Item::factory()->create(['name' => 'Laravel Book']);
        $item2 = \App\Models\Item::factory()->create(['name' => 'PHP Book']);

        $response = $this->get('/?keyword=Laravel');
        $response->assertStatus(200);
        $response->assertSee($item1->name);
        $response->assertDontSee($item2->name);
    }

    public function test_searchMylistItems()
    {
        $user = \App\Models\User::factory()->create();
        $item1 = \App\Models\Item::factory()->create(['name' => 'Laravel Book']);
        $item2 = \App\Models\Item::factory()->create(['name' => 'PHP Book']);
        $item1->followers()->attach($user->id);
        $item2->followers()->attach($user->id);

        $this->actingAs($user);

        $response = $this->get('/?keyword=Laravel');
        $response->assertStatus(200);
        $response->assertSee($item1->name);
        $response->assertDontSee($item2->name);

        $response = $this->get('/mylist?keyword=Laravel');
        $response->assertStatus(200);
        $response->assertSee($item1->name);
        $response->assertDontSee($item2->name);
    }

}
