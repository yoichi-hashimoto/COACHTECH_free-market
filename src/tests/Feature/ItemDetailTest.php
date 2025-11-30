<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use App\Models\Category;

class ItemDetailTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_itemDetail()
    {
        $user = \App\Models\User::factory()->create();
        $item = \App\Models\Item::factory()->create([
            'name' => 'Test Item',
            'description' => 'This is a test item description.',
            'price' => 1000,
            'user_id' => $user->id,
        ]);
        $category = \App\Models\Category::factory()->create();
        $item->categories()->attach($category->id);

        $item->comments()->create([
            'user_id' => $user->id,
            'comment' => 'This is a test comment.',
        ]);

        $response = $this->get('/item/'.$item->id);
        $response->assertStatus(200);

        $response->assertSee('Test Item');
        $response->assertSee('This is a test item description.');
        $response->assertSee('1000');
        $response->assertSee($user->name);


    }

    public function test_itemCategoryDisplay()
    {
        $item = \App\Models\Item::factory()->create();
        $category = \App\Models\Category::factory()->create([
            'name' => 'Test Category',
        ]);
        $item->categories()->attach($category->id);

        $response = $this->get('/item/'.$item->id);
        $response->assertStatus(200);
        $response->assertSee('Test Category');
    }

    public function test_likeButtonStore()
    {
        $user = \App\Models\User::factory()->create();
        $item = \App\Models\Item::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/item/'.$item->id.'/like');
        $response->assertStatus(302);
        $this->assertTrue($item->fresh()->followers->contains($user->id)); 
    }

    public function test_likeButtonColorChange()
    {
        $user = \App\Models\User::factory()->create();
        $item = \App\Models\Item::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/item/'.$item->id.'/like')->assertStatus(302);

        $response = $this->get('/item/'.$item->id);
        $response->assertStatus(200);
        $response->assertSee('star__button--liked');
    }

    public function test_likeButtonCancel()
    {
        $user = \App\Models\User::factory()->create();
        $item = \App\Models\Item::factory()->create();

        $this->actingAs($user);
        $this->post('/item/'.$item->id.'/like');
        $response = $this->post('/item/'.$item->id.'/like');
        $response->assertStatus(302);
        $this->assertFalse($item->fresh()->followers->contains($user->id));
    }

    public function test_CommentSend()
    {
        $user = \App\Models\User::factory()->create();
        $item = \App\Models\Item::factory()->create();

        $this->actingAs($user);

        $formData = [
            'comment' => 'This is a test comment.',
        ];

        $response = $this->post('/item/'.$item->id.'/comment', $formData);
        $response->assertStatus(302);
        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'comment' => 'This is a test comment.',
        ]);
    }

    public function test_CommentOnlyAuthenticatedUsers()
    {
        $item = \App\Models\Item::factory()->create();

        $response = $this->post('/item/'.$item->id.'/comment', ['comment' => 'Test Comment']);
        $response->assertRedirect('/login');
    }

    public function test_CommmentValidationNullContent()
    {
        $user = \App\Models\User::factory()->create();
        $item = \App\Models\Item::factory()->create();

        $this->actingAs($user);

        $formData = [
            'comment' => '',
        ];

        $response = $this->post('/item/'.$item->id.'/comment', $formData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['comment'=>'コメントを入力してください']);
    }

    public function test_CommentValidationExceedMaxLength()
    {
        $user = \App\Models\User::factory()->create();
        $item = \App\Models\Item::factory()->create();

        $this->actingAs($user);

        $formData = [
            'comment' => str_repeat('a', 256),
        ];

        $response = $this->post('/item/'.$item->id.'/comment', $formData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['comment'=>'文字は255文字以内で記入してください']);
    }
}
