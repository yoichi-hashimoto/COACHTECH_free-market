<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $formData = [
            'email' => '',
            'password' => 'password123',
        ];
        $response = $this->post('/login', $formData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email'=>'メールアドレスを入力してください']);
    }

    public function test_passwordValidation()
    {
        $formData = [
            'email' => 'test@example.com',
            'password' => '',
        ];
        $response = $this->post('/login', $formData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['password'=>'パスワードを入力してください']);
    }   

    public function test_failedLogin()
    {
        $formData = [
            'email' => 'unmuch@example.com',
            'password' => 'wrongpassword',
        ];
        $response = $this->post('/login', $formData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email'=>'ログイン情報が登録されていません']);
    }

    public function test_successfulLogin()
    {
        $user = \App\Models\User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);
        $formData = [
            'email' => 'test@example.com',
            'password' => 'password123',
        ];
        $response = $this->post('/login', $formData);
        $response->assertStatus(302);
        $response->assertRedirect('/mypage');
        $this->assertAuthenticatedAs($user);
    }

    public function test_logout()
    {
        $user = \App\Models\User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]); 
        $this->be($user);
        $response = $this->post('/logout');
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertGuest();
    }
}