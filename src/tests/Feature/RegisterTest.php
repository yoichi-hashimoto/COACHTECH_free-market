<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_nameValidation()
    {
        $formData = [
            'name' => '',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $formData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name'=>'名前を入力してください']);
        

    }

    public function test_emailValidation()
    {
        $formData = [
            'name' => 'Test User',
            'email' => '',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $formData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email'=>'メールアドレスを入力してください']);
    }

    public function test_passwordValidation()
    {
        $formData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '',
            'password_confirmation' => '',
        ];

        $response = $this->post('/register', $formData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['password'=>'パスワードを入力してください']);
    }

    public function test_passwordConfirmationValidation()
    {
        $formData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'pass123',
            'password_confirmation' => 'pass123',
        ];

        $response = $this->post('/register', $formData);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['password'=>'パスワードは8文字以上で入力してください']);
    }

    public function test_successfulRegistration()
    {
        $formData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];
        $response = $this->post('/register', $formData);
        $response->assertStatus(302);
        $response->assertRedirect('/emnail/verify');
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        'email_verified_at' => null,'email_token' => anything(),
        ]);

}}