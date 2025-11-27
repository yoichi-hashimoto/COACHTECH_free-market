<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\AuthMail;
use Tests\TestCase;
use Illuminate\Support\Str;

class MailTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_authMailSend(){
        Mail::fake();
        $response = $this->post(route('register'),[
            'name'=>'テスト三郎',
            'email'=>'test@example.com',
            'password'=>'password0123',
            'password_confirm'=>'password0123',
        ]);

        $response ->assertRedirect(route('verification.notice'));

        $user = User::where('email','test@example.com')->first();
        $this -> assertNotNull($user);

        $this -> assertNotNull($user->email_token);

        Mail::assertSent(AuthMail::class,function($mail)use($user){
            return $mail->hasTo($user->email);
        });
    }

    public function test_moveToAuthSite(){
        $user = User::factory()->create([
            'email_token'=>'abcd01234',
            'email_verified_at'=>'null',
        ]);
        
        $response = $this->actingAs($user)
            ->get(route('auth.verify',['token'=>'abcd01234']));
        $response->assertRedirect(route('profile.edit'));

        $user->refresh();
        $this->assertNotNull($user->email_verified_at);
        $this->assertNull($user->email_token);
    }

    public function test_moveToProfileSetting(){
        $user = User::factory()->create([
            'name'=>'テスト四郎',
            'email'=>'test@example.com',
            'email_verified_at'=>'2025-11-23 10:51:07',
            'password'=>'password01234',
            'email_token'=>null,
        ]
        );

        $response = $this->actingAs($user)
            ->post(route('auth.check'));
        $response->assertRedirect(route('profile.edit'))
            ->assertStatus(302);
    }

}
